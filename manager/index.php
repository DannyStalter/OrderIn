<?php
define('admin', true);
session_start();

include '../config.php';

include '../functions.php';

$pdo = pdo_connect_mysql();

if (!isset($_SESSION['account_loggedin'])) {
    header('Location: ../index.php?page=myaccount');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
$stmt->execute([ $_SESSION['account_id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$account || $account['admin'] != 0) {
    header('Location: ../index.php');
    exit;
}

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'orders';
if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

$error = '';

include $page . '.php';
?>
