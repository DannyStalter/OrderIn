<?php
session_start();
if (isset($_SESSION['account_loggedin'])) {
    unset($_SESSION['account_loggedin']);
    unset($_SESSION['account_id']);
    unset($_SESSION['account_admin']);
    unset($_SESSION['cart']);
}
header('Location: index.php');
?>
