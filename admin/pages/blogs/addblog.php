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
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    
    if(!array_filter($errors)){
        $data = $_POST;
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
        }
        $db->Insert('blogs', $data);
        $_SESSION['success'] = "Blog Added Successfully";
        redirect_back();
    }
}


?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Blog Cateogry</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=url("admin")?>">Home</a></li>
                <li class="breadcrumb-item active">Write Blogs</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Wrte Blogs</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2 mb-2">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" selected disabled>Select Category</option>
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
                            <img height="300" width="300" class="mb-2 cover_preview"   src="<?=url($oldValue['image'])  ?>" alt="Cover Image Preview"><br>
                            <input type="file" name="image" value="<?= $oldValue['image'] ?>" id="thumbnail"  class="form-control thumbnail" onchange="previewCoverImage(this);"> <br>
                            <small class="text-danger"><?= $errors['image'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Blog Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" selected disabled>Select Status</option>
                                <option value="1" >Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary">Add News</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->