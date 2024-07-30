<?php
$db = new Database();
?>
<div class="page-wrapper">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Gallery.</h1>
            <div class="side-icon"><i class="fa-regular fa-images"></i></div>
        </div>
        <div class="row gy-4">
            <?php
            $albums = $db->customQuery("SELECT * FROM gallery ORDER BY created_at DESC");
            foreach ($albums as $album) {
                $albumId = intval($album->id);
                $imagesQuery = "SELECT * FROM gallery_images WHERE category_id = $albumId";
                $images = $db->customQuery($imagesQuery);
                if (!empty($images)) {
            ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="<?=url('gallery-single?slug='.$album->slug)?>" class="gallery-card">
                        <figure>
                            <?php
                            $imageUrl = $album->cover ? url($album->cover) : url("public/images/blog.jpg");
                            ?>
                            <img src="<?= $imageUrl ?>" alt="<?= $album->name ?>">
                            <figcaption>
                                <h2><?= $album->name ?></h2>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            <?php 
                } 
            } 
            ?>
        </div>
    </div>
</div>
