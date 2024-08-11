<?php
$db = new Database();
$errors = [
    'cat_name' => '',
];

$oldValue = [
    'cat_name' => '',
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
    $catName = $_POST['cat_name'];
    $sql = "SELECT count(*) as total FROM category WHERE cat_name = '$catName'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['cat_name'] = "Category already exists";
    }
    if (!array_filter($errors)) {
        $data['cat_name'] = $_POST['cat_name'];
        $db->Insert('category', $data);
        $_SESSION['success'] = "Category Created Successfully";
        redirect_back();
    }
}


$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM category WHERE cid = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['cat_name'] = $result->cat_name;
}


if(isset($_POST['update_category'])){
    unset($_POST['update_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $catName = $_POST['cat_name'];
    $sql = "SELECT count(*) as total FROM category WHERE cat_name = '$catName' AND cid != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['cat_name'] = "Category already exists";
    }
    if (!array_filter($errors)) {
        $data['cat_name'] = $_POST['cat_name'];
        $db->Update('category',$data,'cid',$editId);
        $_SESSION['success'] = "Category Updated Successfully";
        header('Location:'.url('admin/blogs/category'));
        exit();
    }
}

if(isset($_GET['did'])){
    $deleteId = $_GET['did'];
    $db->Delete('category','cid',$deleteId);
    $_SESSION['success'] = "Category Deleted Successfully";
    header('Location:'.url('admin/blogs/category'));
    exit();
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Blog Cateogry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Blogs</li>
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
                                    <label for="cat_name">Name:
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" id="cat_name" name="cat_name" value="<?= $oldValue['cat_name'] ?>" class="form-control">
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
                                    <label for="cat_name">Name:
                                    </label>
                                    <input type="text" id="cat_name" name="cat_name" value="" class="form-control">
                                    <span class="text-danger mt-1 d-block"><?= $errors['cat_name'] ?></span>
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
                            $categoryData = $db->All('category');
                            $i = 1;
                            foreach ($categoryData as $category) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $category->cat_name ?></td>
                                    <td>
                                        <a href="<?= url("admin/blogs/category") ?>?eid=<?= $category->cid ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/blogs/category") ?>?did=<?= $category->cid ?>" class="btn btn-danger">Delete</a>
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