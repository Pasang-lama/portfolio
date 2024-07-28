<?php
$db = new Database();

$userdata = $db->customQuery("SELECT name, residence, phone, email, address, age, description,  highlighttext, status From users");
$user = $userdata[0];
?>
<div class="page-wrapper">
    <div class="container">
        <div class="page-header">
            <h1 class="page-tittle">About Me.</h1>
            <div class="side-icon"><i class="fa-solid fa-user"></i></div>
        </div>
        <div class="row gy-4">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about-me-content-wrapper">
                    <h2 class="block-tittle"><?= $user->highlighttext ?> </h2>
                    <div class="text-document-content">
                        <?= $user->description ?>
                    </div>
                    <div class="digital-signature">
                        <figure>
                            <img src="images/signature.png" height="30" alt="Pasang Lama Signature">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <aside class="aside-information">
                    <h2 class="block-tittle">Personal Information</h2>
                    <ul>
                        <li><span>Name:</span><?= $user->name ?></li>
                        <li><span>Age:</span><?= $user->age ?> Years</li>
                        <li><span>Residence:</span><?= $user->residence ?></li>
                        <li><span>Address:</span><?= $user->address ?></li>
                        <li><span>Email:</span><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a>
                        </li>
                        <li><span>Phone:</span><a href="tel:<?= $user->phone ?>"><?= $user->phone ?></a></li>
                        <li><span>Freelance:</span> <?= $user->status == 0 ? "Unavailable" : "Available"; ?></li>
                    </ul>
                    <div class="custom-buttons mt-5">
                        <a href="files/Pasang_lama_CV_UIUX.pdf" download> DOWNLOAD RESUME</a>
                    </div>
                </aside>
            </div>
        </div>
        <section class="custom-margin service-section">
            <div class="sub-heading">
                <h2 class="section-tittle">SERVICES</h2>
            </div>
            <div class="row gy-4 justify-content-center">
                <?php
                $services = $db->customQuery("SELECT * From service");
                foreach ($services as $service) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="service-card">
                            <div class="icon"><?= $service->icon ?></div>
                            <h3 class="service-tittle"><?= $service->title ?></h3>
                            <p><?= $service->description ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
        <section class="custom-margin Client-section">
            <div class="sub-heading">
                <h2 class="section-tittle"> Clients</h2>
            </div>
            <div class="row gy-4 justify-content-center">
                <?php
                $clients = $db->customQuery("SELECT * From client");
                foreach ($clients as $client) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="client-card">
                            <figure>
                                <a href="<?= $client->websiteurl ?>" target="_blank">
                                    <img src="<?= url($client->logo) ?>" alt="<?= $client->name ?>" height="90">
                                </a>
                            </figure>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
        <section class="custom-margin testimonals-section">
            <div class="sub-heading">
                <h2 class="section-tittle">TESTIMONIALS</h2>
            </div>
            <div class="testimonals-slider">
                <?php
                $reviews = $db->customQuery("SELECT * From review");
                foreach ($reviews as $review) {
                ?>
                    <div class="testimonals-cards">
                        <i class="fa-solid fa-quote-left"></i>
                        <p><?=$review->review?></p>
                        <div class="review-des">
                            <figure>
                                <img src="<?=url($review->profile)?>" alt="<?=$review->name?>" height="120">
                            </figure>
                            <div class="des">
                                <h3 class="name"><?=$review->name?></h3>
                                <span><?=$review->post?></span>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </div>
</div>
<script src="<?=url("public/js/jquery-3.6.0.min.js")?>"></script>
<script src="<?= url("public/js/slick.min.js")?>"></script>
<script>
    $(document).ready(function() {
        if ($(".testimonals-slider").length > 0) {
            $(".testimonals-slider ").slick({
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: false,
                responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }
    });
</script>