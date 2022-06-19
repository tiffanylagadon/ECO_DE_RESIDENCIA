<?php

function emptyInput($fname, $lname, $age, $pnumber, $address, $gender, $email){
    $result = null;
    if(empty($fname) || empty($lname) || empty($age) || empty($pnumber) || empty($address) || empty($gender) || empty($email)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidFname($fname){
    $result = null;
    if(strlen($fname) < 2 || strlen($fname) > 40 ){
        $result = true;
    }elseif(!preg_match("/^[a-zA-Z ]*$/",$fname)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidLname($lname){
    $result = null;
    if(strlen($lname) < 2 || strlen($lname) > 40 ){
        $result = true;
    }elseif(!preg_match("/^[a-zA-Z ]*$/",$lname)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidAge($age){
    $result = null;
    if($age < 18 || $age > 100 ){
        $result = true;
    }elseif(!preg_match("/^[0-9]*$/",$age)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidPassword($password){
    $result = null;
    if(strlen($password) <6 || strlen($password) > 40 ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function passwordMismatch($password, $cpassword){
    $result = null;
    if($password !== $cpassword){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidPnumber($pnumber){
    $result = null;
    if(strlen($pnumber) < 11 || strlen($pnumber) > 12 ){
        $result = true;
    }elseif(!preg_match("/^[0-9]*$/",$pnumber)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function pnumberTaken($conn, $pnumber){
    $result = null;
    $sql = "SELECT * FROM users WHERE usersPnumber = ? AND `usersId` <> ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $pnumber, $_SESSION["usersId"]);
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

function invalidEmail($email){
    $result = null;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function emailTaken($conn, $email){
    $result = null;
    $sql = "SELECT * FROM users WHERE usersEmail = ? AND `usersId` <> ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $email, $_SESSION["usersId"]);
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

function personExists($conn, $fname, $lname){
    $result = null;
    $sql = "SELECT * FROM users WHERE usersFname = ? AND usersLname = ? AND `usersId` <> ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $fname, $lname, $_SESSION["usersId"]);
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

function updateUser($conn, $fname, $lname, $age, $pnumber, $address, $gender, $email, $usersId){
    $sql = "UPDATE users SET usersFname=?,usersLname=?,usersAge=?,usersPnumber=?,usersAddress=?,usersGender=?,usersEmail=? WHERE usersId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../user_editprofile.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssissssi', $fname, $lname, $age, $pnumber, $address, $gender, $email, $usersId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $uidExists = getUserInfo($conn, $usersId);

    $_SESSION["usersId"] = $uidExists["usersId"];
    $_SESSION["usersFname"] = $uidExists["usersFname"];
    $_SESSION["usersLname"] = $uidExists["usersLname"];
    $_SESSION["usersAge"] = $uidExists["usersAge"];
    $_SESSION["usersPnumber"] = $uidExists["usersPnumber"];
    $_SESSION["usersAddress"] = $uidExists["usersAddress"];
    $_SESSION["usersGender"] = $uidExists["usersGender"];
    $_SESSION["usersEmail"] = $uidExists["usersEmail"];
    $_SESSION["usersPassword"] = $uidExists["usersPassword"];

    header("location: ../user_editprofile.php?error=none");
    exit();
}

function loginUser($conn,$useremail,$password){
    $uidExists = emailTaken($conn, $useremail);

    if($uidExists === false){
        header("location: ../login.php?error=wrongcredentials");
        exit();
    }

    $pwdHashed = $uidExists["usersPassword"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wrongcredentials");
        exit();
    }elseif ($checkPwd === true) {
        session_start();
        $_SESSION["usersId"] = $uidExists["usersId"];
        $_SESSION["usersFname"] = $uidExists["usersFname"];
        $_SESSION["usersLname"] = $uidExists["usersLname"];
        $_SESSION["usersAge"] = $uidExists["usersAge"];
        $_SESSION["usersPnumber"] = $uidExists["usersPnumber"];
        $_SESSION["usersAddress"] = $uidExists["usersAddress"];
        $_SESSION["usersGender"] = $uidExists["usersGender"];
        $_SESSION["usersEmail"] = $uidExists["usersEmail"];
        $_SESSION["usersPassword"] = $uidExists["usersPassword"];
        header("location: ../profile.php");
        exit();
    }

}