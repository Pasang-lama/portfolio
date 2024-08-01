<?php
$db = new Database();
$userdata = $db->customQuery("SELECT softskill From users");
$user = $userdata[0];
?>
<div class="page-wrapper resume-section">
    <div class="container">
        <div class="page-header">
            <h1 class="page-tittle">Resume</h1>
            <div class="side-icon"><i class="fa-solid fa-file-circle-check"></i></div>
        </div>
        <div class="experence-wrapper">
            <div class="sub-heading">
                <h2 class="section-tittle"> Work Experience</h2>
            </div>
            <ul class="experience">
                <?php
                $experiences = $db->customQuery("SELECT * From experience ORDER BY id DESC");
                foreach ($experiences as $experience) {
                ?>
                    <li>
                        <span class="line-left"></span>
                        <div class="content">
                            <h3><?= $experience->post ?></h3>
                            <div class="company"><?= $experience->company ?> | <span><?= $experience->address ?></span></div>
                            <p class="info">
                                <?= $experience->description ?>
                            </p>
                        </div>
                        <div class="year">
                            <time class="to"><?=diffForHumans($experience->end_date,"M  Y");?></time>
                            <time class="from"><?=diffForHumans($experience->start_date,"M  Y");?></time>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

        <div class="row gy-4 mt-3">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="experence-wrapper ">
                    <div class="sub-heading">
                        <h2 class="section-tittle"> Technical Skills</h2>
                    </div>
                    <div class="progress-bar-wrapper">
                        <?php
                        $technicalskills = $db->customQuery("SELECT * From technicalskill");
                        foreach ($technicalskills as $skill) {
                        ?>  
                            <div class="progress-bar" data-percentage='<?=$skill->level?>%'>
                                <div class="progress-title-holder">
                                    <h3 class="progress-title"><?=$skill->name?></h3>
                                    <span class="progress-number-wrapper">
                                        <span class="progress-number-mark">
                                            <span class="percent"></span>
                                            <span class="down-arrow"></span>
                                        </span>
                                    </span>
                                </div>
                                <div class="progress-content-outter">
                                    <div class="progress-content"></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="experence-wrapper ">
                    <div class="sub-heading">
                        <h2 class="section-tittle"> Soft Skills</h2>
                    </div>
                    <div class="text-document-content">
                        <?= $user->softskill ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="experence-wrapper mt-5">
            <div class="sub-heading">
                <h2 class="section-tittle">Academic Qualification</h2>
            </div>
            <ul class="experience">
                <?php
                $qualifications = $db->customQuery("SELECT * From qualification ORDER BY id DESC");
                foreach ($qualifications as $qualification) {
                ?>
                    <li>
                        <span class="line-left"></span>
                        <div class="content">
                            <h3><?= $qualification->title ?></h3>
                            <div class="company"><?= $qualification->institute ?> | <span><?= $qualification->address ?></span></div>
                            <p class="info">
                                <?= $qualification->description ?>
                            </p>
                        </div>
                        <div class="year">
                            <time class="to"> <?=diffForHumans($qualification->end_date,"M  Y");?></time>
                            <time class="from"> <?=diffForHumans($qualification->start_date,"M  Y");?></time>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<script src="<?= url("public/js/jquery-3.6.0.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('.progress-bar').each(function() {
            $(this).find('.progress-content').animate({
                width: $(this).attr('data-percentage')
            }, 2000);

            $(this).find('.progress-number-mark').animate({
                left: $(this).attr('data-percentage')
            }, {
                duration: 2000,
                step: function(now, fx) {
                    var data = Math.round(now);
                    $(this).find('.percent').html(data + '%');
                }
            });
        });
    });
</script>