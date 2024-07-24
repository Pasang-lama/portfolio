<?php
$db = new Database();

$loginId = $_SESSION['auth']->id;

$sql = "SELECT * FROM users WHERE id=$loginId";

$findData = $db->customQuery($sql);
$user = $findData[0];

$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'old_password' => '',
];

$oldValue = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'profileimg' => '',
    'address' => '',
    'residence' => '',
    'age' => '',
    'map' => '',
    'password' => '',
    'confirm_password' => '',
    'old_password' => '',
    'facebook' => '',
    'instagram' => '',
    'linkedin' => '',
    'behance' => '',
    'twitter' => '',
    'status' => ''
];


if (isset($_POST['update_profile'])) {
    unset($_POST['update_profile']);
    if (empty($_POST['name'])) {
        $errors["name"] = "Name field is required";
    } else {
        $oldValue["name"] = $_POST['name'];
    }
    if (!empty($_FILES['profileimg']['name'])) {
        $ext = pathinfo($_FILES['profileimg']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadDir = public_path("images/users");
        $uploadPath = "$uploadDir/$fileName";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!move_uploaded_file($_FILES['profileimg']['tmp_name'], $uploadPath)) {
            $errors['profileimg'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['profileimg'] = '/public/images/users/' . $fileName;
        }
    }
    
    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['phone'] = $_POST['phone'];
        $data['address'] = $_POST['address'];
        $data['residence'] = $_POST['residence'];
        $data['age'] = $_POST['age'];
        $data['map'] = $_POST['map'];
        $data['status']=$_POST['status'];
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Profile Updated Successfully";
        redirect_back();
    }
}


if (isset($_POST['change_password'])) {
    unset($_POST['change_password']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    $findData = $db->customQuery("SELECT * FROM users WHERE id=$loginId");
    $user = $findData[0];
    $odlP = $user->password;
    $oldPassword = md5($_POST['old_password']);
    if ($odlP != $oldPassword) {
        $errors['old_password'] = "Old password not match";
    }
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if ($password != $confirm_password) {
        $errors['confirm_password'] = "Password does not match";
    }

    if (!array_filter($errors)) {
        $data['password'] = $password;
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Password was successfully changed";
               session_destroy();
               header('Location:' . url('auth'));
               exit();
    }
    print_r($errors);
}


if (isset($_POST['updatesocialmedia'])) {
    unset($_POST['updatesocialmedia']);
    if (!array_filter($errors)) {
        $data['facebook'] = $_POST['facebook'];
        $data['linkedin'] = $_POST['linkedin'];
        $data['twitter'] = $_POST['twitter'];
        $data['instagram'] = $_POST['instagram'];
        $data['behance'] = $_POST['behance'];
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Social Media Acount Updated Successfully";
        redirect_back();
    }
}
?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>General Setting</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" value="<?= $user->name ?>" class="form-control">
                                    <span class="text-danger"><?= $errors['name'] ?></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" value="<?= $user->email ?>" readonly disabled class="form-control">
                                    <span class="text-danger"><?= $errors['email'] ?></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="phone">Phone:</label>
                                    <input type="text" name="phone" value="<?= $user->phone ?>" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="residence">Residence:</label>
                                    <input type="text" name="residence" value="<?= $user->residence ?>" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" value="<?= $user->address ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="age">Age:</label>
                                    <input type="text" name="age" value="<?= $user->age ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="status">Freelance:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" <?= $user->status == '1' ? 'selected' : '' ?>>Available
                                        </option>
                                        <option value="0" <?= $user->status == '0' ? 'selected' : '' ?>>
                                            Not Avilable
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="profileimg">Image</label>
                                    <input type="file" name="profileimg" id="profileimg" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="map">Map</label>
                                    <textarea name="map" id="map" rows="5" class="form-control"><?= $user->map ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <button name="update_profile" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="form-group mb-2">
                            <label for="old_password">Old Password:
                                <span class="text-danger"><?= $errors['old_password'] ?></span>
                            </label>
                            <input type="password" name="old_password" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password:
                                <span class="text-danger"><?= $errors['password'] ?></span>
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Confirm Password:
                                <span class="text-danger"><?= $errors['confirm_password'] ?></span>
                            </label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <button name="change_password" class="btn btn-primary">Change Password</button>
                        </div>

                    </form>
                </div>


            </div>

        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Social Media Accounts</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group mb-2">
                            <label for="facebook">Facebook:</label>
                            <input type="url" name="facebook" value="<?= $user->facebook ?>" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="linkedin">Linkedin:</label>
                            <input type="url" name="linkedin" value="<?= $user->linkedin ?>" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="instagram">Instagram:</label>
                            <input type="url" name="instagram" value="<?= $user->instagram ?>" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="twitter">twitter:</label>
                            <input type="url" name="twitter" value="<?= $user->twitter ?>" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="behance">Behance:</label>
                            <input type="url" name="behance" value="<?= $user->behance ?>" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <button name="updatesocialmedia" class="btn btn-primary">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->