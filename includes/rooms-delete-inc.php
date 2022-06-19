<?php

session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

if(isset($_GET["roomId"])){

    $Id = $_GET["roomId"];

    require_once 'dbh-inc.php';

    //getting the filename
    $sql = "SELECT * FROM rooms WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_rooms.php?error=stmt_failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $Id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);

    $filename = "../uploads/".$row['images']; //we need to concatinate the exact directory folder on the file name that we want to delete

    mysqli_stmt_close($stmt);
    //end

    //deleting actual file on directory
    if (unlink($filename)) {
        
    } else {
        header("location: ../admin_rooms.php?error='There was a error deleting the file ' . $filename;");
    }
    //end

    //deleting file information on database
    $sql = "DELETE FROM rooms WHERE Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_rooms.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $Id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //end
    header("location: ../admin_rooms.php");
    exit();

}else{
    header("location: ../admin_rooms.php");
    exit();
}