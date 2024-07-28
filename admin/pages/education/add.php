<?php
$db = new Database();
$errors = [
    'title' => '',
    'start_date' => '',
    'end_date' => '',
    'status' => '',

];

$oldValue = [
    'title' => '',
    'start_date' => '',
    'end_date' => '',
    'status' => '',
];
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Insert('qualification', $data);
        $_SESSION['success'] = "New Academic Journey has been added Successfully";
        redirect_back();
    }
}


?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1> Academic Degree</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Write Review</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Add Degree</h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="title">Academic Degree Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?= $oldValue['title'] ?>">
                                    <small class="text-danger"><?= $errors['title'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $oldValue['start_date'] ?>">
                                    <small class="text-danger"><?= $errors['start_date'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $oldValue['end_date'] ?>">
                                    <small class="text-danger"><?= $errors['end_date'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="status">Degree Status:</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Degree Status</option>
                                        <option value="1">Completed</option>
                                        <option value="0">Running</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <button class="btn btn-primary">Add Degree</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main><!-- End #main -->