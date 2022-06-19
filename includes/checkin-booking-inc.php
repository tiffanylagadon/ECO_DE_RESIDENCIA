<?php

session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

if(isset($_GET["checkinId"])){

    $Id = $_GET["checkinId"];
    $occupied = 1;

    require_once 'dbh-inc.php';

    $sql = "UPDATE reservations SET occupied=? WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_bookings.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ii', $occupied, $Id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin_bookings.php");
    exit();


}else{
    header("location: ../admin_bookings.php");
    exit();
}