<?php

session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

function emptyInput($currentpassword, $npassword, $cnpassword){
    $result = null;
    if(empty($currentpassword) || empty($npassword) || empty($cnpassword)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidCP($currentpassword, $usersPassword){
    $result = null;
    if($currentpassword !== $usersPassword ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidPassword($npassword){
    $result = null;
    if(strlen($npassword) <6 || strlen($npassword) > 40 ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function passwordMismatch($npassword, $cnpassword){
    $result = null;
    if($npassword !== $cnpassword){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function getUserInfo($conn, $usersId){
    $result = null;
    $sql = "SELECT * FROM users WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usersId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function editpassword($conn, $npassword, $usersId){
    $sql = "UPDATE users SET usersPassword=? WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    $hashedPwd = password_hash($npassword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'si', $hashedPwd, $usersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $uidExists = getUserInfo($conn, $usersId);

    $_SESSION["usersPassword"] = $uidExists["usersPassword"];

    header("location: ../user_editpassword.php?error=none");
    exit();
}
