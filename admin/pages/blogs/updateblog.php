<?php
$db = new Database();
$categoryData = $db->All('category');
$errors = [
    'category_id' => '',
    'title' => '',
    'slug' => '',
    'summary' => '',
    'description' => '',
    'image' => '',
];

$oldValue = [
    'category_id' => '',
    'title' => '',
    'slug' => '',
    'summary' => '',
    'description' => '',
    'image' => '',
];
if (isset($_SESSION['edit_blogid'])) {
    $editid = $_SESSION['edit_blogid'];
    $sql = "SELECT * FROM blogs WHERE nid =  $editid";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['category_id'] = $result->category_id;
    $oldValue['title'] =  $result->title;
    $oldValue['slug'] =  $result->slug;
    $oldValue['summary'] =  $result->summary;
    $oldValue['description'] =  $result->description;
    $oldValue['image'] =  $result->image;
    $oldValue['status'] =  $result->status;
}


if (isset($_POST['updateblogs'])) {
    unset($_POST['updateblogs']);
    foreach ($_POST as $key => $value ) {
        if (empty($value) && $key != 'status') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/blogsimages");
        $uploadPath = "$uploadDir/$fileName";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['image'] = '/public/images/blogsimages/' . $fileName;
        }
    }else{
        $data['image'] = $oldValue['image'];
    }
    if (!array_filter($errors)) {
        $data['category_id'] = $_POST['category_id'];
        $data['title'] = $_POST['title'];
        $data['slug'] = $_POST['slug'];
        $data['summary'] = $_POST['summary'];
        $data['description'] = $_POST['description'];
        $data['status'] = $_POST['status'];
        $editid = $_SESSION['edit_blogid'];
        $db->Update('blogs', $data, 'nid', $editid);
        $_SESSION['success'] = "blogs Updated Successfully";
        redirect_back();
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit Blogs</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Edit Blogs</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2 mb-2">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" selected disabled>Select blog Category</option>
                                <?php foreach ($categoryData as $category) : ?>
                                    <option value="<?= $category->cid ?>" <?= $oldValue['category_id'] == $category->cid ? 'selected' : '' ?>><?= $category->cat_name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger"><?= $errors['category_id'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="blogtitle">Blog Title</label>
                            <input type="text" name="title" id="blogtitle" class="form-control" value="<?= $oldValue['title'] ?>">
                            <small class="text-danger"><?= $errors['title'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?= $oldValue['slug'] ?>">
                            <small class="text-danger"><?= $errors['slug'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="blogsummary">Summary</label>
                            <textarea name="summary" id="blogsummary" class="form-control" rows="5"><?= $oldValue['summary'] ?></textarea>
                            <small class="text-danger"><?= $errors['summary'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="blogdescription">Description</label>
                            <textarea name="description" id="blogdescription" class="form-control" rows="10"><?= $oldValue['description'] ?></textarea>
                            <small class="text-danger"><?= $errors['description'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="thumbnail">Thumbnail</label> <br>
                            <img height="300" width="300" class="mb-2" id="cover_preview"  src="<?=url($oldValue['image'])  ?>" alt="Cover Image Preview"><br>
                            <input type="file" name="image" value="<?= $oldValue['image'] ?>" id="thumbnail"  class="form-control" onchange="previewCoverImage(this);"> <br>
                            <small class="text-danger"><?= $errors['image'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Blog Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value=""  disabled>Select Blog Status</option>
                                <option value="1" <?= $oldValue['status'] ==  1 ? 'selected' : ''?>>Published</option>
                                <option value="0" <?=$oldValue['status'] ==  0 ? 'selected' : '' ?>>Unpublished</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <button name="updateblogs" class="btn btn-primary">Update Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->