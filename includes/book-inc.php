<?php
session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: ../login.php");
    exit();
}

require_once 'dbh-inc.php';

if(isset($_POST["submit"])){

    $room = $_POST["rooms"];

    $optioncounter = 1;
    $query1=mysqli_query($conn,"select * from rooms");
    while($row=mysqli_fetch_array($query1)){

        if($room == $optioncounter){
            $room = $row['roomName'];
            break;

        }
        $optioncounter++;
    }

    $clientName = $_POST["clientName"];
    $clientEmail = $_POST["clientEmail"];
    $clientNumber = $_POST["clientNumber"];
    $checkInDate = $_POST["checkInDate"];
    $checkOutDate = $_POST["checkOutDate"];
    $totalBill = $_POST["totalBill"];

    
    require_once 'book-functions-inc.php';

    if(schedOverlapped($conn, $room, $checkInDate, $checkOutDate) !== false){
        header("location: ../book_loggedin.php?error=schedule_overlapped");
        exit();
    }

    reserve($conn, $room, $clientName, $clientEmail, $clientNumber, $checkInDate, $checkOutDate, $totalBill);

}else{
    header("location: ../login.php");
    exit();
}