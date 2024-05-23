document.getElementById("sidenavOpenBtn").addEventListener("click", function (event) {
  event.preventDefault();
  document.getElementById("SideNav").classList.toggle("open");
  document.body.classList.toggle("open-opacity");
});

$(document).ready(function () {
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
