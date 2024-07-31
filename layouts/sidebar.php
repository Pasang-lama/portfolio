<?php
$db = new Database();
$userdata = $db->customQuery("SELECT name, profileimg, linkedin, facebook, instagram, behance, twitter From users");
$user = $userdata[0];
?>

<div class="side-bar-wrapper" id="SideNav">
    <div class="side-bar">
        <div class="profile-figure">
            <figure>
                <img src=" <?= url($user->profileimg) ?>" alt="<?= $user->name ?>">
            </figure>
            <div class="name"><?= $user->name ?></div>
        </div>
        <div class="main-navigation-menu">
            <ul>
                <li class="active"><a href="/"><i class="fa-solid fa-house-chimney"></i>Home</a></li>
                <li><a href="about"><i class="fa-solid fa-user"></i>About me</a></li>
                <li><a href="resume"><i class="fa-solid fa-file-circle-check"></i>Resume</a></li>
                <li><a href="portfolio"><i class="fa-solid fa-laptop-code"></i>Portfolio</a></li>
                <li><a href="blog"><i class="fa-solid fa-file-pen"></i>Blog</a></li>
                <li><a href="gallery"><i class="fa-regular fa-images"></i>Gallery</a></li>
                <li><a href="contact"><i class="fa-regular fa-address-book"></i>Contact</a></li>
            </ul>
        </div>
        <div class="side-bar-footer">
            <div class="social-media">
                <ul>
                <?php
                        if (!empty($user->facebook)) {
                        ?>
                               <li><a class="facebook  icon-wrapper " href="<?= $user->facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a> </li>
                        <?php
                        }
                        if (!empty($user->twitter)) {
                        ?>
                               <li><a class="twitter icon-wrapper " href="<?= $user->twitter ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a> </li>
                        <?php
                        }
                        if (!empty($user->linkedin)) {
                        ?>
                              <li> <a class="linkedin icon-wrapper  " href="<?= $user->linkedin ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a> </li>
                        <?php
                        }
                        if (!empty($user->instagram)) {
                        ?>
                              <li> <a class="instagram icon-wrapper  " href="<?= $user->instagram ?>" target="_blank"><i class="fab fa-instagram"></i></i></a> </li>
                        <?php
                        }
                        if (!empty($user->behance)) {
                        ?>
                              <li> <a class="icon-wrapper  " href="<?= $user->behance ?>" target="_blank"><i class="fa-brands fa-behance"></i></i></a> </li>
                        <?php
                        }
                        ?>
                </ul>
            </div>

            <div class="copy-right">
                <p>2024 © <?= $user->name ?>. All Right Reserved.</p>
            </div>
        </div>
    </div>
</div>