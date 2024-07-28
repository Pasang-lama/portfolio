<?php
$db = new Database();
$errors = [
    'name' => '',
    'post' => '',
    'review' => '',
    'profile' => '',

];

$oldValue = [
    'name' => '',
    'post' => '',
    'review' => '',
    'profile' => '',
    'status' => '',

];
if (isset($_SESSION['edit_id'])) {
    $editid = $_SESSION['edit_id'];
    $sql = "SELECT * FROM review WHERE id =  $editid";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] =  $result->name;
    $oldValue['post'] =  $result->post;
    $oldValue['review'] =  $result->review;
    $oldValue['status'] =  $result->status;
    $oldValue['profile'] =  $result->profile;

}


if (isset($_POST['update_review'])) {
    unset($_POST['update_review']);
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!empty($_FILES['profile']['name'])) {
        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/review");
        $uploadPath = "$uploadDir/$fileName";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['profile'] = '/public/images/review/' . $fileName;
        }
    } else {
        $data['profile'] = $oldValue["profile"];
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['post'] = $_POST['post'];
        $data['review'] = $_POST['review'];
        $data['status'] = $_POST['status'];
        $editid = $_SESSION['edit_id'];
        $db->Update('review', $data, 'id', $editid);
        $_SESSION['success'] = "Review Updated Successfully";
        redirect_back();
    }
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Client Review</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin">Home</a></li>
                <li class="breadcrumb-item">Review</li>
                <li class="breadcrumb-item active">Edit Review</li>

            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Edit Review</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $oldValue['name'] ?>">
                                    <small class="text-danger"><?= $errors['name'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="post">Post</label>
                                    <input type="text" name="post" id="post" class="form-control" value="<?= $oldValue['post'] ?>">
                                    <small class="text-danger"><?= $errors['post'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="review">Review</label>
                                    <textarea name="review" id="review" class="form-control" rows="8"><?= $oldValue['review'] ?></textarea>
                                    <small class="text-danger"><?= $errors['review'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="profile">Profile:</label>
                                    <input type="file" name="profile" id="profile" class="form-control" value="<?= $oldValue['profile'] ?>">
                                    <small class="text-danger"><?= $errors['profile'] ?></small>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" disabled>Select Status</option>
                                        <option value="1" <?= $oldValue['status'] ==  1 ? 'selected' : '' ?>>Published</option>
                                        <option value="0" <?= $oldValue['status'] ==  0 ? 'selected' : '' ?>>Unpublished</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <button name="update_review" class="btn btn-primary">Update Review</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->