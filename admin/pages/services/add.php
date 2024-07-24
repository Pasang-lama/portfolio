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
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if(!array_filter($errors)){
        $data = $_POST;
        $db->Insert('service', $data);
        $_SESSION['success'] = "Services Added Successfully";
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
                    <h5 class="card-title"> Add Services</h5>
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
                            <input type="text" id="servicesicon" name="icon" class="form-control" value="<?= $oldValue['icon'] ?>">
                            <small class="text-danger"><?= $errors['icon'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary">Add Servies</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->