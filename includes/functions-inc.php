<?php

function emptyInputSignup($name, $email, $pwd, $pwdConfirm) {
	$result;
	if (empty($name) || empty($email) || empty($pwd) || empty($pwdConfirm)) {
		$result = true;
	}
	else {
		$result = false;
  }
	return $result;
}

function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}
function pwdMatch($pwd, $pwdConfirm) {
	$result;
	if ($pwd !== $pwdConfirm) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function uidExists($conn, $email) {
	$sql = "SELECT * FROM users WHERE usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=failed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}
function createUser($conn, $name, $email, $pwd) {
	$sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=failed");
		exit();

	}
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../signup.php?error=none");
	exit();

}

function emptyInputLogin($email, $pwd) {
	$result;
	if (empty($email) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;

	}
	return $result;
}

function loginUser($conn, $email, $pwd) {
	$uidExists = uidExists($conn, $email);

	if ($uidExists === false) {
		header("location: ../login.php?error=invalidlogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=invalidlogin");
		exit();
	}
	else if ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersID"];
		$_SESSION["useremail"] = $uidExists["usersEmail"];
		header("location: ../index.php");
		exit();
	}
}
