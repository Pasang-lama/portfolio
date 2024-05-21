<?php include('includes/header.php');?>
<div class=" landing-page-wrapper" style="background-image:url('./images/background.jpg')">
    <div class="row gy-4 gx-0">
        <div class="col-lg-2">
            <?php include('includes/side-bar.php');?>
        </div>
        <div class="col-lg-10">
            <div class="hero-banner">
                <div class="container">
                    <div class="banner-text">
                        <!-- https://watson-vcard.netlify.app/index-light.html#home -->
                        <h1>Pasang  <span>Lama</span> </h1>
                        <div class="animated-text">I am a <span class="typingText">PHP Laravel Developer</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- typing animation  -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/typed.min.js"></script>
<script>
var typing = new Typed(".typingText", {
  strings: [
    "",
    "PHP Laravel Developer",
    "Freelancer",
    "Web Designer",
    "UI-UX Designer",
    "WordPress Designer",
  ],
  typeSpeed: 100,
  backSpeed: 60,
  loop: true,
});
</script>
<?php include('includes/footer.php');?>