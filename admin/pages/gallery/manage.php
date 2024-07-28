<?php
$db = new Database();
$id = $_GET['mid'];
$gallerySql = $db->customQuery("SELECT name  FROM gallery WHERE id=" . $id);
$gallerySql = $gallerySql[0];
$galleryName = $gallerySql->name;
$photoes = $db->customQuery("SELECT * FROM gallery_images WHERE category_id=" . $id);
$errors = [
    'image' => '',
];

if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('gallery_images', 'id', $deleteId);
    $_SESSION['success'] = "1 Image Deleted Successfully";
    redirect_back();
    exit();
}


if (!empty($_FILES)) {
    if (empty($_FILES['newImage']['name'])) {
        $errors["image"] = "Please select atleast 1 Images.";
    } else {
        $ext = pathinfo($_FILES['newImage']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/gallery/" . $galleryName);
        $uploadPath = "$uploadDir/$fileName";
        if (!move_uploaded_file($_FILES['newImage']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $photoId = $_POST['photo_id'];
            $data['name'] = "/public/images/gallery/" . $galleryName . "/" . $fileName;
            // $db->Insert('gallery_images', $data);
            $db->Update('gallery_images', $data, 'id', $photoId);
            $_SESSION['success'] = $totalSuccess . " Images update Successfully";
            redirect_back();
        }
    }
}

// if (isset($_POST['change_image'])) {
//     unset($_POST['change_image']);
//     foreach ($_POST as $key => $value ) {
//         if (empty($value) && $key != 'status') {
//             $errors[$key] = "This field is required";
//         } else {
//             $oldValue[$key] = $value;
//         }
//     }
//     if (!empty($_FILES['image']['name'])) {
//         $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
//         $fileName = md5(microtime()) . ".$ext";
//         $uploadDir = public_path("images/blogsimages");
//         $uploadPath = "$uploadDir/$fileName";
//         if (!is_dir($uploadDir)) {
//             mkdir($uploadDir, 0755, true);
//         }
//         if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
//             $errors['image'] = "Image Upload Failed";
//             redirect_back();
//         } else {
//             $data['image'] = '/public/images/blogsimages/' . $fileName;
//         }
//     }else{
//         $data['image'] = $oldValue['image'];
//     }
//     if (!array_filter($errors)) {
//         $data['category_id'] = $_POST['category_id'];
//         $data['title'] = $_POST['title'];
//         $data['slug'] = $_POST['slug'];
//         $data['summary'] = $_POST['summary'];
//         $data['description'] = $_POST['description'];
//         $data['status'] = $_POST['status'];
//         $editid = $_SESSION['edit_blogid'];
//         $db->Update('blogs', $data, 'nid', $editid);
//         $_SESSION['success'] = "blogs Updated Successfully";
//         redirect_back();
//     }
// }
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= url('admin/gallery/category') ?>">Gallery</a></li>
                <li class="breadcrumb-item active"><?= $galleryName ?></li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> <?= $galleryName ?></h5>
                </div>
                <div class="card-body">
                    <?= messages() ?>
                    <div class="row gy-4">
                        <?php
                        if (empty($photoes)) {
                        ?>
                            <p class=" mt-5">0 Images Found</p>
                        <?php
                        }
                        foreach ($photoes as $photo) {
                        ?>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="card">
                                    <img src="<?= url($photo->name) ?>" class="card-img-top w-100 object-fit-cover" alt="<?= $galleryName ?>" height="150">
                                    <div class="card-body mt-3">
                                        <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#changeimgmodal" data-cid="<?= $photo->id ?>">Change</a>
                                        <a href="<?= url("admin/gallery/manage?did=" . $photo->id) ?>" class="card-link text-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>


            </div>

        </div>
    </section>
</main>
<!-- modal  -->
<div class="modal fade" id="changeimgmodal" tabindex="-1" aria-labelledby="changeimgmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changeimgmodalLabel">Upload New Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeImageForm" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="photo_id" id="photo_id">
                        <label for="newImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="newImage" name="newImage">
                        <small class="text-danger"><?= $errors['image'] ?></small>
                    </div>
                    <button name="change_image" class="btn btn-primary">Change Image</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var changeImageModal = document.getElementById('changeimgmodal');
    changeImageModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var cid = button.getAttribute('data-cid');
        var modalBodyInput = changeImageModal.querySelector('#photo_id');
        console.log(cid);
        modalBodyInput.value = cid;
    });
</script>
<!-- End #main -->