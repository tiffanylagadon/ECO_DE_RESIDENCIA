<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $text = $_POST["text"];

    require_once 'dbh-inc.php';
    require_once 'contact-functions-inc.php';

    if(emptyInput($name, $email, $text) !== false){
        header("location: ../contact.php?error=emptyinput");
        exit();
    }

    if(invalidName($name) !== false){
        header("location: ../contact.php?error=invalid_name");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../contact.php?error=invalid_email");
        exit();
    }

    if(invalidText($text) !== false){
        header("location: ../contact.php?error=invalid_message");
        exit();
    }

    sendMessage($conn, $name, $email, $text);
    header("location: ../contact.php?error=none");
    exit();

}else{
    header("location: ../contact.php");
    exit();
}