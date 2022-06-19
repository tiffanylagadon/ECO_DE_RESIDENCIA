<?php

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

function roomTaken($conn, $room){
    $result = null;
    $sql = "SELECT * FROM reservations WHERE room = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../book_loggedin.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $room);
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

function roomTaken2($conn, $room, $x){
    $result = null;
    $sql = "SELECT * FROM reservations WHERE room = ? and Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../book_loggedin.php?error=stmt_failed2");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $room,$x);
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

function schedOverlapped($conn, $room, $checkInDate, $checkOutDate){
    $result = null;
    $roomExists = roomTaken($conn, $room);
    $error_counter = 0;
    $x = 0;

    if($roomExists === false){
        $result = false;
        return $result;
    }
    
    //getting max ID on rooms
    $sql = "SELECT MAX(Id) as maxid FROM reservations";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../book_loggedin.php?error=stmt_failed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        $output1 = $row['maxid'];
    }else {
        $output1 = 0;
    }
    
    

    for ($x = 0; $x <= $output1; $x++){

            $sql = "SELECT COUNT(*) as num FROM reservations
            WHERE
            (
            (? >= checkInDate AND ? <= checkOutDate)
            OR
            (? >= checkInDate AND ? <= checkOutDate)
            OR
            (? <= checkInDate AND ? >= checkOutDate)
            )
            AND
            room = ? AND Id = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../book_loggedin.php?error=stmt_failed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sssssssi", $checkInDate, $checkInDate, $checkOutDate, $checkOutDate, $checkInDate, $checkOutDate, $room, $x);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($resultData)){
                $output = $row['num'];
            }else {
                $output = 0;
            }

            if($output > 0){
                header("location: ../book_loggedin.php?error=schedule_overlapped");
                exit();
            }

            //end ng bagong idea  
    }

    if($error_counter == 0){
        $result = false;
        return $result;
    }else{
        $result = true;
        return $result;
    }

}

function reserve($conn, $room, $clientName, $clientEmail, $clientNumber, $checkInDate, $checkOutDate, $totalBill){
    $occupied = 0;
    $sql = "INSERT INTO reservations (room, clientName, clientEmail, clientNumber, checkInDate, checkOutDate, totalBill, occupied) VALUE (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../book_loggedin.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssii", $room, $clientName, $clientEmail, $clientNumber, $checkInDate, $checkOutDate, $totalBill, $occupied);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../book_loggedin.php?error=none");
    exit();
}