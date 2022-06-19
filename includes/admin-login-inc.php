<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'dbh-inc.php';
    require_once 'admin-functions-inc.php';

    if(emptyInputAdminLogin($username, $password) !== false){
        header("location: ../admin.php?error=emptyinput");
        exit();
    }
    else {
        loginAdmin($conn,$username,$password);
    }
    

}else {
    header("location: ../admin.php?error=emptyinput");
    exit();
}