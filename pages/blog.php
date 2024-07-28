<?php
$db = new Database();
$blogs = $db->customQuery("SELECT category.cid,category.cat_name,blogs.* FROM blogs
JOIN category ON blogs.category_id=category.cid WHERE blogs.status = '1' ORDER BY created_at DESC" );
?>
<div class="page-wrapper">
    <div class="container">
        <div class="page-header">
            <h1 class="page-tittle">My Blogs.</h1>
            <div class="side-icon"><i class="fa-solid fa-file-pen"></i></div>
        </div>
        <div class="row gy-4">
            <?php
            foreach ($blogs as $blog) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="<?=url('blog-details?slug='.$blog->slug)?>" class="blog-card">
                        <figure>
                            <?php
                            $imageUrl = $blog->image ? url($blog->image) : url("public/images/blog.jpg");
                            ?>
                            <img src="<?= $imageUrl ?>" alt="<?= $blog->title ?>">
                        </figure>
                        <div class="blog-details">
                            <span><?= $blog->cat_name; ?> </span>
                            <h2 class="blog-tittle"><?= $blog->title ?></h2>
                            <time><?=diffForHumans($blog->created_at,"M d Y");?><time>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>