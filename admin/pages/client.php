<?php
$db = new Database();
$errors = [
    'name' => '',
    'logo' => '',
];

$oldValue = [
    'name' => '',
    'websiteurl' => '',
];

if (isset($_POST['add_client'])) {
    unset($_POST['add_client']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $clientName = $_POST['name'];
    $sql = "SELECT count(*) as total FROM client WHERE name = '$clientName'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Client already exists";
    }

    if (!array_filter($errors)) {
        $data = $_POST;
        if (!empty($_FILES['logo']['name'])) {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $fileName = md5(microtime()) . ".$ext";
            $uploadDir = public_path("images/clients");
            $uploadPath = "$uploadDir/$fileName";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath)) {
                $errors['image'] = "Image Upload Failed";
                redirect_back();
            } else {
                $data['logo'] = '/public/images/clients/' . $fileName;
            }
        }

        $db->Insert('client', $data);
        $_SESSION['success'] = "Client Added Successfully";
        redirect_back();
    }
}


$editId = isset($_GET['eid']) ? $_GET['eid'] : '';
if ($editId) {
    $sql = "SELECT * FROM client WHERE id = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['name'] = $result->name;
    $oldValue['websiteurl'] = $result->websiteurl;
    $oldValue['logo'] = $result->logo;
}


if (isset($_POST['update_client'])) {
    unset($_POST['update_client']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $name = $_POST['name'];
    $sql = "SELECT count(*) as total FROM client WHERE name = '$name' AND id != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['name'] = "Client already exists";
    }
    if (!empty($_FILES['logo']['name'])) {
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/clients");
        $uploadPath = "$uploadDir/$fileName";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['logo'] = '/public/images/clients/' . $fileName;
        }
    }else{
        $data['logo'] = $oldValue["logo"];
    }
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['websiteurl'] = $_POST['websiteurl'];
        $db->Update('client', $data, 'id', $editId);
        $_SESSION['success'] = "Client Details Updated Successfully";
        header('Location:' . url('admin/client'));
        exit();
    }
}

if (isset($_GET['did'])) {
    $deleteId = $_GET['did'];
    $db->Delete('client', 'id', $deleteId);
    $_SESSION['success'] = "Client Deleted Successfully";
    header('Location:' . url('admin/client'));
    exit();
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Our Clients</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Clients</li>
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
                        <h5 class="card-title"> Update Clients</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="name">Name:
                                        </label>
                                        <input type="text" id="name" name="name" value="<?= $oldValue["name"] ?>" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['name'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="websitelink">Website URL:
                                        </label>
                                        <input type="text" value="<?= $oldValue["websiteurl"] ?>" id="websitelink" name="websiteurl" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="logo">Logo:
                                        </label>
                                        <input type="file" id="logo" name="logo" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['logo'] ?></span>

                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <button name="update_client" class="btn btn-primary">Update Client</button>
                                </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <!-- manage category  -->
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title"> Add Clients</h5>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="name">Name:
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['name'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="websitelink">Website URL:
                                        </label>
                                        <input type="text" id="websitelink" name="websiteurl" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="logo">Logo:
                                        </label>
                                        <input type="file" id="logo" name="logo" class="form-control">
                                        <span class="text-danger mt-1 d-block"><?= $errors['logo'] ?></span>

                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <button name="add_client" class="btn btn-primary">Add Client</button>
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
                    <h5 class="card-title"> Clients List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.n</th>
                                <th>logo</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $clients = $db->All('client');
                            $i = 1;
                            foreach ($clients as $client) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img height="100px" src="<?= url($client->logo) ?>" alt="<?= $client->name ?>"></td>
                                    <td><?= $client->name ?></td>
                                    <td>
                                        <a href="<?= url("admin/client") ?>?eid=<?= $client->id ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= url("admin/client") ?>?did=<?= $client->id ?>" class="btn btn-danger">Delete</a>
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