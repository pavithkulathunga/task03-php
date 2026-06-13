<?php

function emptyInputSignup($name, $email, $uid, $password, $confirm_password) {
    if (empty($name) || empty($email) || empty($uid) || empty($password) || empty($confirm_password)) {
        return true;
    }
    return false;
}

function invalidUid($uid) {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        return true;
    }
    return false;
}

function invalidEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function pwdMatch($password, $confirm_password) {
    if ($password !== $confirm_password) {
        return true;
    }
    return false;
}

function uidExists($conn, $uid, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return true;
    }
    mysqli_stmt_close($stmt);
    return false;
    
    
}

function emptyInputLogin($username, $password) {
    if (empty($username) || empty($password)) {
        return true;
    }
    return false;
}

function loginUser($conn, $username, $password) {
    if (uidExists($conn, $username, $username) === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $pwdHashed = $row['usersPwd'];
        $checkPwd = password_verify($password, $pwdHashed);
        if ($checkPwd === false) {
            header("location: ../index.php?error=wronglogin");
            exit();
        } else if ($checkPwd === true) {
            session_start();
            $_SESSION['userid'] = $row['usersId'];
            $_SESSION['useruid'] = $row['usersUid'];
            header("location: ../welcome.php");
            exit();
        }
    }
}
