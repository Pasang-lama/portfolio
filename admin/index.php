<?php
require_once("../helper/config.php");
require_once("../helper/Database.php");
require_once("../vendor/autoload.php");
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
if(!isset($_SESSION['is_login'])){
    $url =url('auth');
    header('Location:'.$url);
    exit();
}
$uri = isset($_GET['uri']) ? $_GET['uri'] : 'dashboard';
$uri = str_replace(".php", "", $uri);
$title = ucfirst($uri);
$uri = $uri . ".php";
$pagePath = "pages/" . $uri;
// require_once("layouts/header.php");
// require_once("layouts/sidebar.php");
if (file_exists($pagePath) && is_file($pagePath)) {
    require_once($pagePath);
} else {
    require_once("../helper/404.php");
}
require_once("layouts/footer.php");
