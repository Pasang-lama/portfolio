<?php
$db = new Database();
$slug = $_GET['slug'];
$gallery = $db->customQuery("SELECT name FROM gallery WHERE gallery.slug = '$slug'");
$gallery = $gallery[0];
?>
<div class="page-wrapper">
    <div class="container">
        <div class="page-header">
            <h1 class="page-tittle"><?= $gallery->name ?>.</h1>
            <div class="side-icon"><i class="fa-regular fa-images"></i></div>
        </div>
        <ul class="gallery-grid">
            <?php
            $photos = $db->customQuery("SELECT gallery.id, gallery.slug, gallery_images.* FROM gallery_images JOIN  gallery ON gallery_images.category_id = gallery.id  WHERE gallery.slug = '$slug'");
            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $imageUrl = $photo->name ? url($photo->name) : url("public/images/blog.jpg");

            ?>
                    <li style="--n: 0;">
                        <a data-fancybox="<?= $slug ?>" data-caption="<?= $gallery->name ?>" href="<?= $imageUrl ?>">
                            <figure>
                                <img src="<?= $imageUrl ?>" alt="<?= $gallery->name ?>">
                            </figure>
                        </a>
                    </li>
                <?php
                }
            } else {
                ?>
                <p>No Images Found</p>
            <?php

            }
            ?>

        </ul>
    </div>
</div>
<script src=" <?= url('public/js/fancybox.umd.js') ?>"></script>
