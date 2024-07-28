<?php
$db = new Database();
$errors = [
    'name' => '',
    'level' => '',
];

$oldValue = [
    'name' => '',
    'level' => '',
];
if (isset($_POST['add_skill'])) {
    unset($_POST['add_skill']);
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $data = $_POST;
    $skilltitle = $_POST['name'];
    $sql = "SELECT count(*) as total FROM technicalskill WHERE name = '$skilltitle'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Skill already exists";
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $db->Insert('technicalskill', $data);
        $_SESSION['success'] = "Skill Added Successfully";
        redirect_back();
    }
}



$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM technicalskill WHERE id = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] = $result->name;
    $oldValue['level'] = $result->level;
}

if (isset($_POST['update_skill'])) {
    unset($_POST['update_skill']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $skilltitle = $_POST['name'];
    $sql = "SELECT count(*) as total FROM technicalskill WHERE name = '$skilltitle' AND id != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Skill already exists";
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['level'] = $_POST['level'];
        $db->Update('technicalskill', $data, 'id', $editId);
        $_SESSION['success'] = "1 Item Updated Successfully";
        header('Location:' . url('admin/skill/technical'));
        exit();
    }
}


if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('technicalskill', 'id', $deleteId);
    $_SESSION['success'] = "1 Item Deleted Successfully";
    header('Location:' . url('admin/skill/technical'));
    exit();
}


?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Technical Skills</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Technical Skills</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
        <?php if ($editId) : ?>
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Update Technical Skills </h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name">Title</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $oldValue['name'] ?>">
                                    <small class="text-danger"><?= $errors['name'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="level">Expert Level <i class="text-danger">(Percentage)</i></label>
                                    <input type="number" name="level" id="level" class="form-control" value="<?= $oldValue['level'] ?>">
                                    <small class="text-danger"><?= $errors['level'] ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button name="update_skill" class="btn btn-primary">Update Skills</button>
                        </div>
                    </form>
                </div>

            </div>
            <?php else : ?>
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Add Technical Skills </h5>
                    <?php messages(); ?>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name">Title</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $oldValue['name'] ?>">
                                    <small class="text-danger"><?= $errors['name'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="level">Expert Level <i class="text-danger">(Percentage)</i></label>
                                    <input type="number" name="level" id="level" class="form-control" value="<?= $oldValue['level'] ?>">
                                    <small class="text-danger"><?= $errors['level'] ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button  name="add_skill" class="btn btn-primary">Add Skills</button>
                        </div>
                    </form>
                </div>

            </div>
            <?php endif ?>
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Technical Skills </h5>
                </div>
                <?php ?>
                <div class="card-body">
                    <form action="" method="post">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Expert Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $skills = $db->All('technicalskill');
                                if (!empty($skills)) {
                                    $i = 1;
                                    foreach ($skills as $skill) {
                                ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $skill->name ?></td>
                                            <td><?= $skill->level ?>%</td>
                                            <td>
                                                <a href="<?= url("admin/skill/technical?eid=" . $skill->id) ?>" class="btn btn-primary">Edit</a>
                                                <a href="<?= url("admin/skill/technical?did=" . $skill->id) ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center">NO Record Found</p>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </form>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->