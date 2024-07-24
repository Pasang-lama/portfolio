<?php
 $project_name = $_ENV['App_NAME'];  
if (isset($_FILES['upload']['name'])) {
    $file = $_FILES['upload']['tmp_name'];
    $file_name = $_FILES['upload']['name'];
    $file_name_array = explode(".", $file_name);
    $extension = end($file_name_array);
    $new_image_name = rand() . '.' . $extension;
    chmod('public/ckeditor-image', 0777);
    move_uploaded_file($file, 'public/ckeditor-image/' . $new_image_name);
    $function_number = $_GET['CKEditorFuncNum'];
    $url = 'http://localhost/'.$project_name.'/public/ckeditor-image/' . $new_image_name;
    $message = 'Image uploaded successfully';
    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
}


