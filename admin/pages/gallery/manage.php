<?php
$db = new Database();
$id = $_GET['mid'];
$gallerySql = $db->customQuery("SELECT name FROM gallery WHERE id=" . $id);
$gallerySql = $gallerySql[0];
$galleryName = $gallerySql->name;
if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('gallery_images', 'id', $deleteId);
    $_SESSION['success'] = "Images Deleted Successfully";
    redirect_back();
    exit();
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= url('admin/gallery/category') ?>">Gallery</a></li>
                <li class="breadcrumb-item active"><?= $galleryName ?></li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> <?= $galleryName ?></h5>
                </div>
                <div class="card-body">
                    <div class="row gy-4">
                        <?php
                        $photoes = $db->customQuery("SELECT name FROM gallery_images WHERE category_id=" . $id);
                        foreach ($photoes as $photo) {
                        ?>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="card">
                                    <img src="<?= url($photo->name) ?>" class="card-img-top w-100" alt="<?= $galleryName ?>" height="150">
                                    <div class="card-body mt-3">
                                        <a href="<?= url("admin/gallery/manage?cid=".$photo->id) ?>" class="card-link">Change</a>
                                        <a href="<?= url("admin/gallery/manage?did=".$photo->id) ?>" class="card-link text-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                            
                        <?php
                        }
                        ?>

                    </div>
                </div>


            </div>

        </div>
    </section>
</main><!-- End #main -->