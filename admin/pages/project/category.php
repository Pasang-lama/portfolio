<?php
$db = new Database();
$errors = [
    'name' => '',
];

$oldValue = [
    'name' => '',
];

if (isset($_POST['add_category'])) {
    unset($_POST['add_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $catName = $_POST['name'];
    $sql = "SELECT count(*) as total FROM projectcategory WHERE name = '$catName'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Category already exists";
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $db->Insert('projectcategory', $data);
        $_SESSION['success'] = "Category Created Successfully";
        redirect_back();
    }
}


$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM projectcategory WHERE id = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] = $result->name;
}


if (isset($_POST['update_category'])) {
    unset($_POST['update_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $catName = $_POST['name'];
    $sql = "SELECT count(*) as total FROM projectcategory WHERE name = '$catName' AND id != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Category already exists";
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $db->Update('projectcategory', $data, 'id', $editId);
        $_SESSION['success'] = "Category Updated Successfully";
        header('Location:' . url('admin/project/category'));
        exit();
    }
}

if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('projectcategory', 'id', $deleteId);
    $_SESSION['success'] = "Category Deleted Successfully";
    header('Location:' . url('admin/project/category'));
    exit();
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Project Cateogry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->


    <section class="section dashboard">
        <div class="row">
            <!-- update category  -->
            <?php if ($editId) : ?>
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"> Update Category</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-group mb-2">
                                    <label for="name">Name:
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" id="name" name="name" value="<?= $oldValue['name'] ?>" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <button name="update_category" class="btn btn-primary">Update Category</button>
                                </div>
                        </form>


                    </div>
                </div>
            <?php else : ?>
                <!-- manage category  -->
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"> Manage Category</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="form-group mb-2">
                                    <label for="name">Name:
                                    </label>
                                    <input type="text" id="name" name="name" value="" class="form-control">
                                    <span class="text-danger mt-1 d-block"><?= $errors['name'] ?></span>
                                </div>
                                <div class="form-group mb-2">
                                    <button name="add_category" class="btn btn-primary">Add Category</button>
                                </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <!-- display category  -->
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Category List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.n</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categoryData = $db->All('projectcategory');
                            $i = 1;
                            foreach ($categoryData as $category) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $category->name ?></td>
                                    <td>
                                        <a href="<?= url("admin/project/category") ?>?eid=<?= $category->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/project/category") ?>?did=<?= $category->id ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                            <?php
                            }

                            ?>

                        </tbody>
                    </table>

                </div>


            </div>

        </div>

    </section>
</main><!-- End #main -->