$(document).ready(function () {
  if ($(".testimonals-slider").length > 0) {
    $(".testimonals-slider ").slick({
      slidesToShow: 2,
      slidesToScroll: 2,
      infinite: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      dots: false,
      responsive: [
        {
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
  if ($(".popup-youtube").length > 0) {
    $(".popup-youtube").magnificPopup({
      disableOn: 700,
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });
  }
});
//  typing animation effect
var typing = new Typed(".typingText", {
  strings: [
    "",
    "PHP Laravel Developer",
    "Freelancer",
    "Graphics Designer",
    "Web Designer",
    "UI-UX Designer",
    "WordPress Designer",
  ],
  typeSpeed: 100,
  backSpeed: 60,
  loop: true,
});
