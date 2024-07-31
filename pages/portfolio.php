<?php
$db = new Database();
$projects = $db->customQuery("SELECT slug, thumbnail, title, frontend, category FROM project WHERE frontend = '1'");
$projectcategory = $db->customQuery("SELECT * FROM projectcategory");
$projectsByCategory = [];

foreach ($projects as $project) {
    $projectsByCategory[$project->category][] = $project;
}

?>
<div class="page-wrapper">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Portfolio</h1>
            <div class="side-icon"><i class="fa-solid fa-laptop-code"></i></div>
        </div>
        <section class="portfolio-page">
            <nav>
                <div class="nav portfolio-tabs" id="portfolio-tabs" role="tablist">
                    <button class="nav-link active" id="all-project-tab" data-bs-toggle="tab" data-bs-target="#all-project" type="button" role="tab" aria-controls="all-project" aria-selected="true">All Projects</button>
                    <?php
                    $i = 1;
                    foreach ($projectcategory as $category) {
                        if (isset($projectsByCategory[$category->id])) {
                    ?>
                            <button class="nav-link" id="category-tab-<?= $i ?>" data-bs-toggle="tab" data-bs-target="#category-<?= $i ?>" type="button" role="tab" aria-controls="category-<?= $i ?>" aria-selected="false"><?= $category->name ?></button>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </nav>
            <div class="tab-content" id="portfolio-tabsContent">
                <div class="tab-pane fade show active" id="all-project" role="tabpanel" aria-labelledby="all-project-tab" tabindex="0">
                    <div class="row gy-4 justify-content-center">
                        <?php
                        foreach ($projects as $project) {
                        ?>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="project-card">
                                    <a href="<?= url('project-details?slug=' . $project->slug) ?>">
                                        <figure>
                                            <img src="<?= url($project->thumbnail) ?>" alt="<?= $project->title ?>">
                                        </figure>
                                        <h2><?= $project->title ?></h2>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $i = 1;
                foreach ($projectcategory as $category) {
                    if (isset($projectsByCategory[$category->id])) {
                ?>
                        <div class="tab-pane fade" id="category-<?= $i ?>" role="tabpanel" aria-labelledby="category-tab-<?= $i ?>" tabindex="0">
                            <div class="row gy-4 justify-content-center">
                                <?php
                                foreach ($projectsByCategory[$category->id] as $project) {
                                ?>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="project-card">
                                            <a href="<?= url('project-details?slug=' . $project->slug) ?>">
                                                <figure>
                                                    <img src="<?= url($project->thumbnail) ?>" alt="<?= $project->title ?>">
                                                </figure>
                                                <h2><?= $project->title ?></h2>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </section>
    </div>
</div>