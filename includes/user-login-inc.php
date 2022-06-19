<?php

if(isset($_POST["submit"])){
    $useremail = $_POST["useremail"];
    $password = $_POST["password"];

    require_once 'dbh-inc.php';
    require_once 'user-functions-inc.php';

    if(emptyInputUserLogin($useremail, $password) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    else {
        loginUser($conn,$useremail,$password);
    }
    

}else {
    header("location: ../login.php?error=emptyinput");
    exit();
}