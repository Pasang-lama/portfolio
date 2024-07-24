<?php
require_once("../helper/config.php");
session_start();
session_destroy();
header('Location:'.url(""));