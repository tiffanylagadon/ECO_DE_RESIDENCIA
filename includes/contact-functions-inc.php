<?php

function emptyInput($name, $email, $text){
    $result = null;
    if(empty($name) || empty($email) || empty($text)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidName($name){
    $result = null;
    if(strlen($name) < 2 || strlen($name) > 50 ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidText($text){
    $result = null;
    if(strlen($text) <6){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function sendMessage($conn, $name, $email, $text){
    $sql = "INSERT INTO messages (usersName, usersEmail, usersMessage) VALUE (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../contact_loggedin.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $text);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}
