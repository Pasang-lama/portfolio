<?php
$db = new Database();
$loginId = $_SESSION['auth']->id;
$sql = "SELECT * FROM users WHERE id=$loginId";
$findData = $db->customQuery($sql);
$user = $findData[0];
$errors = [
    'softskill' => '',
];
$oldValue = [
    'softskill' => '',
];

if (isset($_POST['update_soft_skill'])) {
    unset($_POST['update_soft_skill']);
    if (empty($_POST['softskill'])) {
        $errors["softskill"] = "Softskill field is required";
    } else {
        $oldValue["softskill"] = $_POST['softskill'];
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Softskill Updated Successfully";
        redirect_back();
    }
}
?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SotSkills </h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body mt-2">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="softskill">Softskill Description:</label>
                                    <textarea name="softskill" id="softskill"  class="form-control" rows="10"><?= $user->softskill ?></textarea>
                                    <span class="text-danger"><?= $errors['softskill'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button name="update_soft_skill" class="btn btn-primary">Update Soft Skills</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->