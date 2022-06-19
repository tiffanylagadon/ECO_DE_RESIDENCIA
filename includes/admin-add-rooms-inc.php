<?php

if(isset($_POST["submit"])){

    //assigning the submitted informations through post method on the local variables
    $roomname = $_POST["roomname"];
    $roomrate = $_POST["roomrate"];
    $roomdescription = $_POST["roomdescription"];

    $file = $_FILES['images'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    //end

    //checking if file is valid in terms of format, error, size
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 5000000){
               
            }else{
                header("location: ../admin_add_room.php?error=invalid_file_size");
                exit();
            }
        }else{
            header("location: ../admin_add_room.php?error=uploading_error");
            exit();
        }
    }else{
        header("location: ../admin_add_room.php?error=invalid_file_format");
        exit();
    }
    //end

    //importing database and functions for validations
    require_once 'dbh-inc.php';
    require_once 'admin-add-rooms-functions-inc.php';
    //end

    //validating file informations
    if(emptyInput($roomname, $roomrate, $roomdescription) !== false){
        header("location: ../admin_add_room.php?error=emptyinput");
        exit();
    }

    if(invalidRoomName($roomname) !== false){
        header("location: ../admin_add_room.php?error=invalid_roomname");
        exit();
    }

    if(invalidRoomRate($roomrate) !== false){
        header("location: ../admin_add_room.php?error=invalid_roomrate");
        exit();
    }

    if(invalidDescription($roomdescription) !== false){
        header("location: ../admin_add_room.php?error=invalid_description");
        exit();
    }
    //end

    //adding file informations on database
    addRoom($conn, $roomname, $roomrate, $roomdescription,$fileName);
    //end

        //getting the latest data that has been added on the database. In this case the main goal is to get the id of the latest data
        $sql = "SELECT * FROM rooms ORDER BY Id DESC LIMIT 1;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin_add_room.php?error=stmt_failed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($resultData);

        $roomId = $row['Id'];

        mysqli_stmt_close($stmt);
        //end

        //renaming the file base on the file title and finally uploading the file on the root folder
        $file = $_FILES['images'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 5000000){
                    $fileNameNew = "image".$roomId.".".$fileActualExt;
                    $fileDestination = '../uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                }else{
                    header("location: ../admin_add_room.php?error=invalid_file_size");
                    exit();
                }
            }else{
                header("location: ../admin_add_room.php?error=uploading_error");
                exit();
            }
        }else{
            header("location: ../admin_add_room.php?error=invalid_file_format");
            exit();
        }
        //end

        //updating file name after renaming the file and uploading it on the root folder
        $sql = "UPDATE rooms SET images=? WHERE Id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin_add_room.php?error=stmt_failed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'si', $fileNameNew, $roomId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../admin_add_room.php?error=none");
        exit();
        //end

    }else{
        header("location: ../admin_add_room.php");
        exit();
    }
