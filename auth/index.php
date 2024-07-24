<?php
require_once("../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
require_once("../helper/config.php");
require_once("../helper/Database.php");
$db = new Database();
$data['name'] = "Pasang Lama";
$data['email'] = "admin@pasang-lama.com.np";
$data['password'] = md5("Pasang@321");
$query = 'SELECT count(*) as total FROM users';
$stmt = $db->customQuery($query);
$findData = array_shift($stmt);
if ($findData->total < 1) {
    $db->Insert('users', $data);
}
$errors = [
    'email' => '',
    'password' => '',
];
$oldValue = [
    'email' => '',
    'password' => '',
];
if (!empty($_POST)) {

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please insert correct e-mail.";
    }
    $password = md5($_POST['password']);
    if (!array_filter($errors)) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $response = $db->customQuery($sql);
        if ($response) {
            $user = $response[0];
            unset($user->password);
            $_SESSION['auth'] = $user;
            $_SESSION['is_login'] = true;
            header('Location:'.url('/admin'));
        } else {
            $_SESSION['error'] = "Invalid Email or Password";
            redirect_back();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= url('public/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= url('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= url('public/assets/css/style.css') ?>" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Pasang Lama</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>

                                    <?php messages(); ?>

                                    <form class="row g-3 needs-validation" method="post">
                                        <div class="col-12">
                                            <label for="youremail" class="form-label">E-mail:</label>
                                            <input type="email" name="email" class="form-control" value="<?= $oldValue['email'] ?>" id="youremail">
                                            <small class="text-danger"><?= $errors['email'] ?></small>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" value="<?= $oldValue['password'] ?>">
                                            <small class="text-danger"><?= $errors['password'] ?></small>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src=" <?= url('public/assets/js/main.js') ?>"></script>
</body>

</html>