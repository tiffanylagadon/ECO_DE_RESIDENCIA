<?php

if(isset($_POST["submit"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $pnumber = $_POST["pnumber"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    require_once 'dbh-inc.php';
    require_once 'user-functions-inc.php';

    if(emptyInput($fname, $lname, $age, $pnumber, $address, $gender, $email, $password, $cpassword) !== false){
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if(invalidFname($fname) !== false){
        header("location: ../register.php?error=invalid_firstname");
        exit();
    }

    if(invalidLname($lname) !== false){
        header("location: ../register.php?error=invalid_lastname");
        exit();
    }

    if(invalidAge($age) !== false){
        header("location: ../register.php?error=invalid_age");
        exit();
    }

    if(invalidPnumber($pnumber) !== false){
        header("location: ../register.php?error=invalid_phonenumber");
        exit();
    }

    if(pnumberTaken($conn, $pnumber) !== false){
        header("location: ../register.php?error=phonenumber_already_taken");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../register.php?error=invalid_email");
        exit();
    }

    if(emailTaken($conn, $email) !== false){
        header("location: ../register.php?error=email_already_taken");
        exit();
    }

    if(invalidPassword($password) !== false){
        header("location: ../register.php?error=invalid_password");
        exit();
    }

    if(passwordMismatch($password, $cpassword) !== false){
        header("location: ../register.php?error=password_mismatch");
        exit();
    }

    if(personExists($conn, $fname, $lname) !== false){
        header("location: ../register.php?error=person_already_exists");
        exit();
    }

    createUser($conn, $fname, $lname, $age, $pnumber, $address, $gender, $email, $password);

}else{
    header("location: ../register.php");
    exit();
}