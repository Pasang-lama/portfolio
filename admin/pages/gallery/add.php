<?php
$db = new Database();
$id = $_GET['aid'];
$gallerySql = $db->customQuery("SELECT slug FROM gallery WHERE id=" . $id);
$gallerySql = $gallerySql[0];
$errors = [
    'image' => '',
];
if (!empty($_POST)) {
    if (empty($_POST['image'])) {
        $errors["image"] = "Please select atleast 1 Images.";
    }
    if (!empty($_FILES)) {
        $galleryName = $gallerySql->slug;
        $uploadDir = public_path("images/gallery/".$galleryName);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $totalSuccess=0;
        foreach ($_FILES['images']['name'] as $key => $file) {
            $fileName = $_FILES['images']['name'][$key];
            $tmmName = $_FILES['images']['tmp_name'][$key];
            $uploadPath = "$uploadDir/$fileName";
            if(move_uploaded_file($tmmName,$uploadPath)){
                $totalSuccess+=1;
                $data['category_id']=$id;
                $data['name']="/public/images/gallery/".$galleryName."/".$fileName;
                $db->Insert('gallery_images',$data);
            }   
        }
        $_SESSION['success'] = $totalSuccess. " Images Added Successfully";
        redirect_back();
    }
}

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
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Gallery</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label for="imageInput">Thumbnail</label> <br>
                            <div class="preview-container" id="previewContainer"></div>
                            <input type="file" name="images[]" value="<?= $oldValue['image'] ?>" id="imageInput" multiple class="form-control" onchange="previewCoverImage(this);"> <br>
                            <small class="text-danger"><?= $errors['image'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <button name="updateblogs" class="btn btn-primary">Add Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->