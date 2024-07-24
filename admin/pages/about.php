<?php
$db = new Database();
$loginId = $_SESSION['auth']->id;
$sql = "SELECT * FROM users WHERE id=$loginId";
$findData = $db->customQuery($sql);
$user = $findData[0];
$errors = [
    'description' => '',
];
$oldValue = [
    'highlighttext' => '',
    'description' => '',
];

if (isset($_POST['update_aboutus_content'])) {
    unset($_POST['update_aboutus_content']);
    if (empty($_POST['description'])) {
        $errors["description"] = "Profile Description field is required";
    } else {
        $oldValue["description"] = $_POST['description'];
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Profile description Updated Successfully";
        redirect_back();
    }
}
?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">About me</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body mt-2">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="highlighttext">Highlight Heading:</label>
                                    <input type="text" name="highlighttext" value="<?= $user->highlighttext ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="description">Profile Description:</label>
                                    <textarea name="description" id="aboutusdescription"  class="form-control" rows="10"><?= $user->description ?></textarea>
                                    <span class="text-danger"><?= $errors['description'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button name="update_aboutus_content" class="btn btn-primary">Update Description</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->