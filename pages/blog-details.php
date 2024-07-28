<?php
$db = new Database();
$slug = $_GET['slug'];
$blogsDetails = $db->customQuery("SELECT category.cid,category.cat_name,blogs.* FROM blogs JOIN category ON blogs.category_id=category.cid WHERE slug = '$slug'");
$blogsDetails = $blogsDetails[0];
?>
<figure class="details-page-thumbnail">
    <?php
    $imageUrl = $blogsDetails->image ? url($blogsDetails->image) : url("public/images/blog.jpg");
    ?>
    <img src="<?=  $imageUrl?>" alt="<?= $blogsDetails->title ?>">
</figure>
<div class="container pb-5">
    <div class="page-header-wrapper">
        <span class="category"><?= $blogsDetails->cat_name; ?></span>
        <h1 class="page-title"><?= $blogsDetails->title ?></h1>
        <time> <?=diffForHumans($blogsDetails->created_at,"M d Y");?> <time>
    </div>
    <div class="text-document-content px-lg-5 px-md-5 ">
        <?= $blogsDetails->description ?>
    </div>
</div>