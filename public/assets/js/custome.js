$(document).ready(function () {

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    $('#blogtitle').keyup(function () {
        var value = $(this).val();
        $('#slug').val(slugify(value));
    });
    $('#albumName').keyup(function () {
        var value = $(this).val();
        $('#albumSlug').val(slugify(value));
    });

    CKEDITOR.replace('blogsummary', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.replace('blogdescription', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.replace('aboutusdescription', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.replace('servicesDescription', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
});
function previewCoverImage(input) {
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = ''; // Clear previous previews

    // Store the file input for clearing it later
    const fileInput = input;

    const files = input.files;

    for (const file of files) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const container = document.createElement('div');
                container.classList.add('preview-item');
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.margin = '10px';
                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'Delete';
                deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                deleteBtn.style.marginTop = '5px';
                deleteBtn.onclick = function() {
                    container.remove();
                    if (previewContainer.children.length === 0) {
                        fileInput.value = ''; 
                    }
                };
                container.appendChild(img);
                container.appendChild(deleteBtn);
                previewContainer.appendChild(container);
            };
            reader.readAsDataURL(file);
        }
    }
}
