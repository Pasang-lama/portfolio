<?php
$db = new Database();
$errors = [
    'title' => '',
    'description' => '',
    'icon' => '',
];
$oldValue = [
    'title' => '',
    'description' => '',
    'icon' => '',
];

if (isset($_SESSION['edit_id'])) {
    $editid = $_SESSION['edit_id'];
    $sql = "SELECT * FROM service WHERE id =  $editid";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['title'] =  $result->title;
    $oldValue['description'] =  $result->description;
    $oldValue['icon'] =  $result->icon;
}

if (isset($_POST['update_service'])) {
    unset($_POST['update_service']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!array_filter($errors)) {
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        $data['icon'] = $_POST['icon'];
        $editid = $_SESSION['edit_id'];
        $db->Update('service', $data, 'id', $editid);
        $_SESSION['success'] = "Services Updated Successfully";
        redirect_back();
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Edit Services</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group mb-2">
                            <label for="servicestitle">Title</label>
                            <input type="text" name="title" id="servicestitle" class="form-control" value="<?= $oldValue['title'] ?>">
                            <small class="text-danger"><?= $errors['title'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="servicesDescription">Description</label>
                            <textarea name="description" id="servicesDescription" class="form-control" rows="10"><?= $oldValue['description'] ?></textarea>
                            <small class="text-danger"><?= $errors['description'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="servicesicon">Services Icon</label> 
                            <input type="text" id="servicesicon" name="icon" class="form-control" value='<?= $oldValue['icon'] ?>'>
                            <small class="text-danger"><?= $errors['icon'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <button name="update_service" class="btn btn-primary">Update Servies</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->