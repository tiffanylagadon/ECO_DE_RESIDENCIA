<?php

session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

if(isset($_POST["submit"])){

    $usersId = $_SESSION["usersId"];
    $usersPassword = $_SESSION["usersPassword"];
    $currentpassword = $_POST["password"];
    $npassword = $_POST["npassword"];
    $cnpassword = $_POST["cnpassword"];
    
    require_once 'dbh-inc.php';
    require_once 'user-editpassword-functions-inc.php';

    if(emptyInput($currentpassword, $npassword, $cnpassword) !== false){
        header("location: ../user_editpassword.php?error=emptyinput");
        exit();
    }

    if(invalidCP($currentpassword, $usersPassword) !== false){
        header("location: ../user_editpassword.php?error=invalid_currentpassword");
        exit();
    }

    if(invalidPassword($npassword) !== false){
        header("location: ../user_editpassword.php?error=invalid_password");
        exit();
    }

    if(passwordMismatch($npassword, $cnpassword) !== false){
        header("location: ../user_editpassword.php?error=password_mismatch");
        exit();
    }

    editpassword($conn, $npassword, $usersId);

}else{
    header("location: ../user_editpassword.php");
    exit();
}