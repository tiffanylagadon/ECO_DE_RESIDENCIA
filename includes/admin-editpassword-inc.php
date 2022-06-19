<?php

session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

if(isset($_POST["submit"])){

    $usersId = $_SESSION["adminId"];
    $usersPassword = $_SESSION["adminPassword"];
    $currentpassword = $_POST["password"];
    $npassword = $_POST["npassword"];
    $cnpassword = $_POST["cnpassword"];
    
    require_once 'dbh-inc.php';
    require_once 'admin-editpassword-functions-inc.php';

    if(emptyInput($currentpassword, $npassword, $cnpassword) !== false){
        header("location: ../admin_editpassword.php?error=emptyinput");
        exit();
    }

    if(invalidCP($currentpassword, $usersPassword) !== false){
        header("location: ../admin_editpassword.php?error=invalid_currentpassword");
        exit();
    }

    if(invalidPassword($npassword) !== false){
        header("location: ../admin_editpassword.php?error=invalid_password");
        exit();
    }

    if(passwordMismatch($npassword, $cnpassword) !== false){
        header("location: ../admin_editpassword.php?error=password_mismatch");
        exit();
    }

    editpassword($conn, $npassword, $usersId);

}else{
    header("location: ../admin_editpassword.php");
    exit();
}