<?php

function emptyInput($fname, $lname, $age, $pnumber, $address, $gender, $email, $password, $cpassword){
    $result = null;
    if(empty($fname) || empty($lname) || empty($age) || empty($pnumber) || empty($address) || empty($gender) || empty($email) || empty($password) || empty($cpassword)){
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
    $sql = "SELECT * FROM admin WHERE usersPnumber = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../adminregistration.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $pnumber);
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
    $sql = "SELECT * FROM admin WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../adminregistration.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
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
    $sql = "SELECT * FROM admin WHERE usersFname = ? AND usersLname = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../adminregistration.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $fname, $lname);
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

function createUser($conn, $fname, $lname, $age, $pnumber, $address, $gender, $email, $password){
    $sql = "INSERT INTO admin (usersFname, usersLname, usersAge, usersPnumber, usersAddress, usersGender, usersEmail, usersPassword) VALUE (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../adminregistration.php?error=stmt_failed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssisssss", $fname, $lname, $age, $pnumber, $address, $gender, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../adminregistration.php?error=none");
    exit();
}


function emptyInputAdminLogin($username, $password){
    $result = null;
    if(empty($username) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function loginAdmin($conn,$username,$password){
    $uidExists = emailTaken($conn, $username);

    if($uidExists === false){
        header("location: ../admin.php?error=wrongcredentials");
        exit();
    }

    $pwdHashed = $uidExists["usersPassword"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: ../admin.php?error=wrongcredentials");
        exit();
    }elseif ($checkPwd === true) {
        session_start();
        $_SESSION["adminId"] = $uidExists["usersId"];
        $_SESSION["adminFname"] = $uidExists["usersFname"];
        $_SESSION["adminLname"] = $uidExists["usersLname"];
        $_SESSION["adminAge"] = $uidExists["usersAge"];
        $_SESSION["adminPnumber"] = $uidExists["usersPnumber"];
        $_SESSION["adminAddress"] = $uidExists["usersAddress"];
        $_SESSION["adminGender"] = $uidExists["usersGender"];
        $_SESSION["adminEmail"] = $uidExists["usersEmail"];
        $_SESSION["adminPassword"] = $password;
        header("location: ../dashboard.php");
        exit();
    }
}