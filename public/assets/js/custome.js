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
    $('#projecttitle').keyup(function () {
        var value = $(this).val();
        $('#projectSlug').val(slugify(value));
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
    CKEDITOR.replace('softskill', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.replace('servicesDescription', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
    CKEDITOR.replace('projectDescription', {
        filebrowserUploadUrl: "http://localhost/portfolio/ckeditor-upload.php",
        filebrowserUploadMethod: "form"
    });
});
function previewCoverImage(input) {
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';
    const filesArray = Array.from(input.files); // Convert FileList to an array

    filesArray.forEach((file, index) => {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const container = document.createElement('div');
                container.classList.add('preview-item', 'text-center', 'col-lg-3', 'col-md-4', 'col-6');
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.height = '150px';
                img.classList.add('w-100', 'img-fluid', 'object-fit-cover');
                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'Delete';
                deleteBtn.classList.add('btn', 'btn-danger', 'mt-3' , 'btn-sm');
                deleteBtn.style.marginTop = '5px';
                deleteBtn.onclick = function () {
                    container.remove();
                    filesArray[index] = null; // Mark the file as null
                    updateFileInput(); // Update the file input
                };
                container.appendChild(img);
                container.appendChild(deleteBtn);
                previewContainer.appendChild(container);
            };
            reader.readAsDataURL(file);
        }
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer(); // Create a new DataTransfer object
        filesArray.forEach(file => {
            if (file) {
                dataTransfer.items.add(file); // Add non-null files to DataTransfer object
            }
        });
        input.files = dataTransfer.files; // Update the input's files property
    }
}

