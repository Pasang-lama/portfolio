<?php

session_start();
ob_start();

if (!function_exists("url")) {
    function url($url = "")
    {
        $host = $_SERVER['HTTP_HOST'];
        $project_name = $_ENV['App_NAME'];
        $url = trim($url, "/");
        return "http://" . $host . "/" . $url;
    }
}


if (!function_exists("admin_url")) {
    function admin_url($url = "")
    {
        return url('/admin/' . $url);
    }
}

if (!function_exists("public_path")) {
    function public_path($path = "")
    {
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        $project_name = $_ENV['App_NAME'];
        $path = trim($path, "/");
        return $docRoot .  "/public/" . $path;
    }
}

if (!function_exists("redirect_back")) {
    function redirect_back()
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? url();
        header("Location:" . $referer);
        exit();
    }
}


if (!function_exists("messages")) {
    function messages()
    {
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
    }
}

if (!function_exists("diffForHumans")) {
    function diffForHumans($date, $yourFormat = "Y-m-d")
    {
        $datetime = new DateTime($date);
        return $datetime->format($yourFormat);
    }
}



if (!function_exists("pr")) {
    function pr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (!function_exists("dd")) {
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}




if (!function_exists("fileUpload")) {
    function fileUpload($files, $location = "images")
    {
        $uploadDir = public_path($location);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileArray = [];

        if (is_array($files) && isset($files['name'])) {
            $files = [$files];
        }

        foreach ($files as $key => $file) {
            $fileName = $file['name'];
            $tmpName = $file['tmp_name'];
            $uploadPath = "$uploadDir/$fileName";
            if (move_uploaded_file($tmpName, $uploadPath)) {
                $fileArray[$key] = "public/" . $location . '/' . $fileName;
            }
        }
        return $fileArray;
    }
}
