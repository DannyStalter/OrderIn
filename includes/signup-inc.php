<?php

if (isset($_POST["submit"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	$pwdConfirm = $_POST["pwdconfirm"];

	require_once 'dbh-inc.php';
	require_once 'functions-inc.php';


	if (emptyInputSignup($name, $email, $pwd, $pwdConfirm) !== false) {
		header("location: ../signup.php?error=emptyinput");
		exit();
	}
  
	if (invalidEmail($email) !== false) {
		header("location: ../signup.php?error=invalidemail");
		exit();
	}
	if (pwdMatch($pwd, $pwdConfirm) !== false) {
		header("location: ../signup.php?error=inconsistentpasswords");
		exit();
	}
	if (uidExists($conn, $email) !== false) {
		header("location: ../signup.php?error=emailused");
		exit();
	}

	createUser($conn, $name, $email, $pwd);

}
else {
	header("location: ../signup.php");
	exit();
}
