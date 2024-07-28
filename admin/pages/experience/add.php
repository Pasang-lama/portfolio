<?php
$db = new Database();
$errors = [
    'post' => '',
    'company' => '',
    'address' => '',
    'description' => '',
    'start_date' => '',
    'end_date' => '',
    'status' => '',

];

$oldValue = [
    'post' => '',
    'company' => '',
    'address' => '',
    'description' => '',
    'start_date' => '',
    'end_date' => '',
    'status' => '',
];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status' && !($key == 'end_date' && $_POST['status'] == '0')) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if ($_POST['status'] == '0') {
        $_POST['end_date'] = 'Present';
    } else {
        $start_date = new DateTime($_POST['start_date']);
        $end_date = new DateTime($_POST['end_date']);
        if ($end_date < $start_date) {
            $errors['end_date'] = "End Date cannot be earlier than Start Date.";
        }
    }

    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Insert('experience', $data);
        $_SESSION['success'] = "1 record has been added Successfully";
        redirect_back();
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Experience</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Add Experience</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Add Experience</h5>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post"  id="experienceform">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="post">Designation:</label>
                                    <input type="text" name="post" id="post" class="form-control" value="<?= $oldValue['post'] ?>">
                                    <small class="text-danger"><?= $errors['post'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="company">company:</label>
                                    <input type="text" name="company" id="company" class="form-control" value="<?= $oldValue['company'] ?>">
                                    <small class="text-danger"><?= $errors['company'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="address">Company Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="<?= $oldValue['address'] ?>">
                                    <small class="text-danger"><?= $errors['address'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="start_date">Start Date</label>
                                    <input type="month" name="start_date" id="start_date" class="form-control" value="<?= $oldValue['start_date'] ?>">
                                    <small class="text-danger"><?= $errors['start_date'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                   Current Job Status: <br>
                                    <input class="form-check-input" type="radio" name="status" id="completed" value="1" <?= ($oldValue['status'] == '1') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="completed">Left Job</label>
                                    <input class="form-check-input" type="radio" name="status" id="running" value="0" <?= ($oldValue['status'] == '0') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="running">Still Working Here</label>
                                </div>
                            </div>
                            <div class="col-md-6" id="endDateGroup" style="display: none;">
                                <div class="form-group mb-2">
                                    <label for="end_date">End Date</label>
                                    <input type="month" name="end_date" id="end_date" class="form-control" value="<?= $oldValue['end_date'] ?>">
                                    <small class="text-danger"><?= $errors['end_date'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description"  class="form-control" rows="5" id="description"><?= $oldValue['description'] ?></textarea>
                                    <small class="text-danger"><?= $errors['description'] ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary" type="submit">Add Degree</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var status = "<?= $oldValue['status'] ?>";
    var endDateGroup = document.getElementById('endDateGroup');
    var endDateInput = document.getElementById('end_date');
    if (status == '1') { // Completed
        endDateGroup.style.display = 'block';
    } else {
        endDateGroup.style.display = 'none';
        endDateInput.value = 'Present';
    }
    document.querySelectorAll('input[name="status"]').forEach(function(elem) {
        elem.addEventListener('change', function() {
            if (this.value == '1') { // Completed
                endDateGroup.style.display = 'block';
                endDateInput.value = "<?= $oldValue['end_date'] ?>";
            } else {
                endDateGroup.style.display = 'none';
                endDateInput.value = 'Present';
            }
        });
    });
});



</script>
