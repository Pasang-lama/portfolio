<?php
require_once("vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once("helper/config.php");
require_once("helper/Database.php");
require("helper/mail.php");
$uri = isset($_GET['uri']) ? $_GET['uri'] : 'home';
$uri = str_replace(".php", "", $uri);
$title = ucfirst($uri);
$uri = $uri . ".php";
$pagePath = "pages/" . $uri;
require_once("layouts/header.php");
?>

<div class="row gy-4 gx-0">
    <div class="col-lg-2">
      <!-- <?php  require_once("layouts/sidebar.php"); ?> -->
    </div>
    <div class="col-lg-10  ">
        <?php
        if (file_exists($pagePath) && is_file($pagePath)) {
            require_once($pagePath);
        } else {
            require_once("helper/404.php");
        }
        ?>
    </div>
</div>
<?php require_once("layouts/footer.php"); ?>