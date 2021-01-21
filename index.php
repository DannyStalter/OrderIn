<?php
define('orderinsystem', true);
session_start();

include 'config.php';

include 'functions.php';

$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

$error = '';

include $page . '.php';
?>
