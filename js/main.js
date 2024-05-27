document.getElementById("sidenavOpenBtn").addEventListener("click", function (event) {
  event.preventDefault();
  document.getElementById("SideNav").classList.toggle("open");
  document.body.classList.toggle("open-opacity");
});

