document.getElementById("sidenavOpenBtn").addEventListener("click", function (event) {
  event.preventDefault();
  document.getElementById("SideNav").classList.toggle("open");
  document.body.classList.toggle("open-opacity");
});

function previewCoverImage(input) {
  const preview = document.querySelectorAll('.cover_preview');
  if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
          preview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
  } else {
      preview.src = document.querySelectorAll('.thumbnail').value;
  }
}