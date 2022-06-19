<?php

session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

if(isset($_GET["cancelId"])){

    $Id = $_GET["cancelId"];

    require_once 'dbh-inc.php';

    //getting data
    $sql = "SELECT * FROM reservations WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_bookings.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $Id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);

    $room = $row['room'];
    $clientName = $row['clientName'];
    $clientEmail = $row['clientEmail'];
    $clientNumber = $row['clientNumber'];
    $checkInDate = $row['checkInDate'];
    $checkOutDate = $row['checkOutDate'];
    $totalBill = $row['totalBill'];
    $status = 'cancelled';

    mysqli_stmt_close($stmt);

    //inserting data from reservations to history
    $sql = "INSERT INTO history (Id, room, clientName, clientEmail, clientNumber, checkInDate, checkOutDate, totalBill, transtatus) VALUE (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../book_loggedin.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "issssssis", $Id, $room, $clientName, $clientEmail, $clientNumber, $checkInDate, $checkOutDate, $totalBill, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    //deleting data on reservations
    $sql = "DELETE FROM reservations WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_bookings.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $Id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin_bookings.php");
    exit();

}else{
    header("location: ../admin_bookings.php");
    exit();
}