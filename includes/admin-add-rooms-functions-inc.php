<?php

function emptyInput($roomname, $roomrate, $roomdescription){
    $result = null;
    if(empty($roomname) || empty($roomrate) || empty($roomdescription)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidRoomName($roomname){
    $result = null;
    if(strlen($roomname) < 2 || strlen($roomname) > 40 ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidRoomRate($roomrate){
    $result = null;
    if($roomrate < 800 || $roomrate > 100000 ){
        $result = true;
    }elseif(!preg_match("/^[0-9]*$/",$roomrate)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidDescription($roomname){
    $result = null;
    if(strlen($roomname) < 10 || strlen($roomname) > 500 ){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function addRoom($conn, $roomname, $roomrate, $roomdescription, $fileName){
    $sql = "INSERT INTO rooms (roomName, roomRate, roomDescription, images) VALUE (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin_add_room.php?error=stmt_failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $roomname, $roomrate, $roomdescription, $fileName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}