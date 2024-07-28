<div class=" hero-banner landing-page-wrapper" style="background-image:url( <?= ("public/images/background.jpg"); ?> )">
    <div class="container">
        <div class="banner-text">
            <h1>Pasang <span>Lama</span> </h1>
            <div class="animated-text">I am a <span class="typingText">PHP Laravel Developer</span> </div>
        </div>
    </div>
</div>
<script src="<?= url("public/js/jquery-3.6.0.min.js")?>"></script>
<script src="<?= url("public/js/typed.min.js")?>"></script>
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