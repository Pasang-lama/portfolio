<?php
$db = new Database();
$errors = [
    'name' => '',
    'cover' => '',
    'slug' => '',
];
$oldValue = [
    'name' => '',
    'cover' => '',
    'slug' => '',
];
if (isset($_POST['add_gallery_category'])) {
    unset($_POST['add_gallery_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $albumName = $_POST['name'];
    $sql = "SELECT count(*) as total FROM gallery WHERE name = '$albumName'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Album already exists";
    }

    if (!array_filter($errors)) {
        $data = $_POST;
        if (!empty($_FILES['cover']['name'])) {
            $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
            $fileName = md5(microtime()) . ".$ext";
            $uploadDir = public_path("images/gallery");
            $uploadPath = "$uploadDir/$fileName";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            if (!move_uploaded_file($_FILES['cover']['tmp_name'], $uploadPath)) {
                $errors['image'] = "Image Upload Failed";
                redirect_back();
            } else {
                $data['cover'] = '/public/images/gallery/' . $fileName;
            }
        }

        $db->Insert('gallery', $data);
        $_SESSION['success'] = "Gallery Album Added Successfully";
        redirect_back();
    }
}
$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM gallery WHERE id = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] = $result->name;
    $oldValue['cover'] = $result->cover;
}
if (isset($_POST['update_gallery_album'])) {
    unset($_POST['update_gallery_album']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $name = $_POST['name'];
    $sql = "SELECT count(*) as total FROM gallery WHERE name = '$name' AND id != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Gallery Album already exists";
    }
    if (!empty($_FILES['cover']['name'])) {
        $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/gallery");
        $uploadPath = "$uploadDir/$fileName";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!move_uploaded_file($_FILES['cover']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['cover'] = '/public/images/gallery/' . $fileName;
        }
    } else {
        $data['cover'] = $oldValue["cover"];
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['slug'] = $_POST['slug'];
        $db->Update('gallery', $data, 'id', $editId);
        $_SESSION['success'] = "Gallery Album Updated Successfully";
        header('Location:' . url('admin/gallery/category'));
        exit();
    }
}
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('gallery', 'id', $deleteId);
    $_SESSION['success'] = "Gallery Album Deleted Successfully";
    header('Location:' . url('admin/gallery/category'));
    exit();
}
// if (isset($_GET['mid'])) {
//     $albumid = $_GET['mid'];
//     $_SESSION['album_id'] = $albumid ;
//     header('Location:' . url('admin/gallery/manage'));
//     exit();
// }
// unset($_SESSION['album_id']);
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- update category  -->
            <?php if ($editId) : ?>
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"> Update Gallery Category</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="albumName">Album Name:
                                        </label>
                                        <input type="text" id="albumName" name="name" value="<?= $oldValue["name"] ?>" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['name'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="albumSlug">Slug:</label>
                                        <input type="text" id="albumSlug" name="slug" value="<?= $oldValue["slug"] ?>" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['slug'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="cover">Album Cover:
                                        </label>
                                        <input type="file" id="cover" name="cover" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['cover'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <button name="update_gallery_album" class="btn btn-primary">Update Gallery Album</button>
                                </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <!-- manage category  -->
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"> Add Gallery Album</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="albumName">Album Name:</label>
                                        <input type="text" id="albumName" name="name" value="<?= $oldValue["name"] ?>" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['name'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="albumSlug">Slug:</label>
                                        <input type="text" id="albumSlug" name="slug" value="<?= $oldValue["slug"] ?>" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['slug'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="cover">Album Cover:</label>
                                        <input type="file" id="cover" name="cover" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['cover'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <button name="add_gallery_category" class="btn btn-primary">Add Gallery Album</button>
                                </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <!-- display category  -->
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Album List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Album Cover</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $albums = $db->All('gallery');
                            $i = 1;
                            foreach ($albums as $album) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img height="100px" src="<?= url($album->cover) ?>" alt="<?= $album->name ?>"></td>
                                    <td><?= $album->name ?></td>
                                    <td>
                                        <a href="<?= url("admin/gallery/category?eid=".$album->id)?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/gallery/add?aid=".$album->id)?>" class="btn btn-success">Add Image</a>
                                        <a href="<?= url("admin/gallery/manage?mid=".$album->id) ?>" class="btn text-light btn-info">Manage</a>
                                        <a href="<?= url("admin/gallery/category?did=". $album->id) ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->