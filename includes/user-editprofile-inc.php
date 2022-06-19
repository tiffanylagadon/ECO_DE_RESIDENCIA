<?php

session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

if(isset($_POST["submit"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $pnumber = $_POST["pnumber"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $usersId = $_SESSION["usersId"];

    require_once 'dbh-inc.php';
    require_once 'user-editprofile-functions-inc.php';

    if(emptyInput($fname, $lname, $age, $pnumber, $address, $gender, $email) !== false){
        header("location: ../user_editprofile.php?error=emptyinput");
        exit();
    }

    if(invalidFname($fname) !== false){
        header("location: ../user_editprofile.php?error=invalid_firstname");
        exit();
    }

    if(invalidLname($lname) !== false){
        header("location: ../user_editprofile.php?error=invalid_lastname");
        exit();
    }

    if(invalidAge($age) !== false){
        header("location: ../user_editprofile.php?error=invalid_age");
        exit();
    }

    if(invalidPnumber($pnumber) !== false){
        header("location: ../user_editprofile.php?error=invalid_phonenumber");
        exit();
    }

    if(pnumberTaken($conn, $pnumber) !== false){
        header("location: ../user_editprofile.php?error=phonenumber_already_taken");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../user_editprofile.php?error=invalid_email");
        exit();
    }

    if(emailTaken($conn, $email) !== false){
        header("location: ../user_editprofile.php?error=email_already_taken");
        exit();
    }

    if(personExists($conn, $fname, $lname) !== false){
        header("location: ../user_editprofile.php?error=person_already_exists");
        exit();
    }

    updateUser($conn, $fname, $lname, $age, $pnumber, $address, $gender, $email, $usersId);

}else{
    header("location: ../user_editprofile.php");
    exit();
}