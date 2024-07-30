       <?php
        $db = new Database();
        $slug = $_GET['slug'];
        $projectdetails = $db->customQuery("SELECT projectcategory.id,projectcategory.name,project.* FROM project JOIN projectcategory ON project.category=projectcategory.id WHERE slug = '$slug'");
        $projectdetails = $projectdetails[0];

        ?>
       <figure class="details-page-thumbnail">
           <?php
            $imageUrl = $projectdetails->cover ? url($projectdetails->cover) : url($projectdetails->thumbnail);
            ?>
           <img src="<?= $imageUrl ?>" alt="<?= $projectdetails->name ?>">
       </figure>
       <div class="container pb-5">
           <div class="page-header-wrapper">
               <span class="category"><?= $projectdetails->name ?></span>
               <h1 class="page-title"><?= $projectdetails->title ?></h1>
           </div>
           <div class="row gy-4">
               <div class="col-lg-8 col-md-12 col-sm-12">
                   <h2 class="block-tittle"> Project Overview</h2>
                   <div class="text-document-content">
                       <?= $projectdetails->description ?>
                   </div>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12">
                   <aside class="aside-information">
                       <h2 class="block-tittle">Project Information</h2>
                       <ul>
                           <?php
                            if ($projectdetails->delivery_date !== "Working") {
                            ?>
                               <li><span>Year:</span><?= $projectdetails->delivery_date ?></li>
                           <?php
                            }
                            ?>
                           <li><span>Role:</span><?= $projectdetails->role ?></li>
                           <li><span>Type:</span><?= $projectdetails->name ?></li>
                           <li><span>Technology used:</span><?= $projectdetails->technology ?></li>
                       </ul>
                       <?php
                        if (!empty($projectdetails->siteurl)) {
                        ?>
                           <div class="custom-buttons mt-5">
                               <a href="<?= $projectdetails->siteurl?>" target="_blank">VIEW SITE <i class="ps-2 fa-solid fa-link"></i></a>
                           </div>
                       <?php
                        }
                        ?>

                   </aside>
               </div>
           </div>
       </div>