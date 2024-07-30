<?php
$db = new Database();
$categoryData = $db->All('projectcategory');
$errors = [
    'category' => '',
    'title' => '',
    'slug' => '',
    'thumbnail' => '',
    'description' => '',
    'role' => '',
    'technology' => '',
    'cover' => '',
];

$oldValue = [
    'category' => '',
    'title' => '',
    'slug' => '',
    'thumbnail' => '',
    'description' => '',
    'delivery_date' => '',
    'role' => '',
    'technology' => '',
    'cover' => '',
    'status' => '',
    'frontend' => '',
    'siteurl' => '',
];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'status' && $key != 'frontend' && $key != 'siteurl' && $key != 'delivery_date') {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if ($_POST['status'] != 'Delivered') {
        $_POST['delivery_date'] = 'Working';
    }
    if (!array_filter($errors)) {
        $data = $_POST;
        $image= fileUpload($_FILES, 'images/project');
        if ($image['thumbnail']) {
            $data['thumbnail']=$image['thumbnail'];
        }
        if ($image['cover']) {
            $data['cover']=$image['cover'];
        }
        $db->Insert('project', $data);
        $_SESSION['success'] = "Project Added Successfully";
        redirect_back();
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Project</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url("admin") ?>">Home</a></li>
                <li class="breadcrumb-item active">Add Project</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title"> Add Project</h5>
                    <?php messages();
                    ?>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected disabled>Select Project Category</option>
                                        <?php foreach ($categoryData as $category) : ?>
                                            <option value="<?= $category->id ?>" <?= $oldValue['category'] == $category->id ? 'selected' : '' ?>><?= $category->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= $errors['category'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projecttitle">Project Title</label>
                                    <input type="text" name="title" id="projecttitle" class="form-control" value="<?= $oldValue['title'] ?>">
                                    <small class="text-danger"><?= $errors['title'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectSlug">Slug</label>
                                    <input type="text" name="slug" id="projectSlug" class="form-control" value="<?= $oldValue['slug'] ?>">
                                    <small class="text-danger"><?= $errors['slug'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role:</label>
                                    <input type="text" name="role" id="role" class="form-control" value="<?= $oldValue['role'] ?>">
                                    <small class="text-danger"><?= $errors['role'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="technology">Technology used:</label>
                                    <input type="text" name="technology" id="technology" class="form-control" value="<?= $oldValue['technology'] ?>">
                                    <small class="text-danger"><?= $errors['technology'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Project Status:</label>
                                    <select name="status" id="status" class="form-select" onchange="toggleFields(this.value)">
                                        <option value="" selected disabled>Select Project Status</option>
                                        <option value="Planning">Planning</option>
                                        <option value="Designing">Designing</option>
                                        <option value="Review">Review</option>
                                        <option value="Development">Development</option>
                                        <option value="Testing">Testing</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="deliveryYearField" style="display: none;">
                                <div class="form-group">
                                    <label for="delivery_date">Project Delivery Date:</label>
                                    <input type="month" name="delivery_date" id="delivery_date" class="form-control" value="<?= $oldValue['delivery_date'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="siteurl">Project URL:</label>
                                    <input type="url" name="siteurl" id="siteurl" class="form-control" value="<?= $oldValue['siteurl'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumbnail">Project Thumbnail</label> <br>
                                    <input type="file" name="thumbnail" value="<?= $oldValue['thumbnail'] ?>" id="thumbnail" class="form-control thumbnail" onchange="previewCoverImage(this);"> <br>
                                    <small class="text-danger"><?= $errors['thumbnail'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cover">Project Cover:</label> <br>
                                    <input type="file" name="cover" value="<?= $oldValue['cover'] ?>" id="cover" class="form-control cover" onchange="previewCoverImage(this);"> <br>
                                    <small class="text-danger"><?= $errors['cover'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectDescription">Description</label>
                                    <textarea name="description" id="projectDescription" class="form-control" rows="10"><?= $oldValue['description'] ?></textarea>
                                    <small class="text-danger"><?= $errors['description'] ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    Show on Frontend: <br>
                                    <input class="form-check-input" type="radio" name="frontend" id="show" value="1" <?= ($oldValue['frontend'] == '1') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="show">Show</label>
                                    <input class="form-check-input" type="radio" name="frontend" id="hide" value="0" <?= ($oldValue['frontend'] == '0') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="hide">Hide</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-primary">Add Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script>
    function toggleFields(status) {
        const deliveryYearField = document.getElementById('deliveryYearField');
        if (status === 'Delivered') {
            deliveryYearField.style.display = 'block';
        } else {
            deliveryYearField.style.display = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        const statusSelect = document.getElementById('status');
        toggleFields(statusSelect.value);
    });
</script>