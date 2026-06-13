<?php

if (isset($_POST['submit'])) {

$name = $_POST['name'];
$email = $_POST['email'];
$uid = $_POST['uid'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


if (emptyInputSignup($name, $email, $uid, $password, $confirm_password) !== false) {

    header("location: ../register.php?error=emptyinput");
    exit();
}
if (invalidUid($uid) !== false) {
    header("location: ../register.php?error=invaliduid");
    exit();
}
if (invalidEmail($email) !== false) {
    header("location: ../register.php?error=invalidemail");
    exit();
}
if (pwdMatch($password, $confirm_password) !== false) {
    header("location: ../register.php?error=passwordsdontmatch");
    exit();
}
if (uidExists($conn, $uid, $email) !== false) {
    header("location: ../register.php?error=usernametaken");
    exit();
}

function createUser($conn, $name, $email, $uid, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

createUser($conn, $name, $email, $uid, $password);
header("location: ../register.php?error=none");
exit();

} else {
    header("location: ../register.php");
    exit();
}
    