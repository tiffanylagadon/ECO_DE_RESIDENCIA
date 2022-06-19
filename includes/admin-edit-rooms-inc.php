<?php
session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

if(isset($_POST["submit"])){

    //getting submitted info
    $Id = $_SESSION["roomId"];
    $roomname = $_POST["roomname"];
    $roomrate = $_POST["roomrate"];
    $roomdescription = $_POST["roomdescription"];
    //end

    //first way of updating the file where the file itself also is being updated or replaced by another new file
    if(file_exists($_FILES['images']['tmp_name']) || is_uploaded_file($_FILES['images']['tmp_name'])) { //condition that will return true is there is an uploaded file

        //getting the information of file
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
                    header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_file_size");
                    exit();
                }
            }else{
                header("location: ../admin_edit_room.php?roomId=$Id&error=uploading_error");
                exit();
            }
        }else{
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_file_format");
            exit();
        }
        //end

        //importing database and functions for validations
        require_once 'dbh-inc.php';
        require_once 'admin-edit-rooms-functions-inc.php';
        //end

        //validating file informations
        if(emptyInput($roomname, $roomrate, $roomdescription) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=emptyinput");
            exit();
        }

        if(invalidRoomName($roomname) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_roomname");
            exit();
        }

        if(invalidRoomRate($roomrate) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_roomrate");
            exit();
        }

        if(invalidDescription($roomdescription) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_description");
            exit();
        }
        //end

        //getting the filename of the previous file that will going to be replaced
        $sql = "SELECT * FROM rooms WHERE Id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin_edit_room.php?roomId=$Id&error=stmt_failed");
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
            header("location: ../admin_edit_room.php?roomId=$Id&error='There was a error deleting the file ' . $filename;");
        }
        //end

        //updating file informations on database
        editRoom($conn, $roomname, $roomrate, $roomdescription,$fileName,$Id);
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
                        $fileNameNew = "image".$Id.".".$fileActualExt;
                        $fileDestination = '../uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                    }else{
                        header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_file_size");
                        exit();
                    }
                }else{
                    header("location: ../admin_edit_room.php?roomId=$Id&error=uploading_error");
                    exit();
                }
            }else{
                header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_file_format");
                exit();
            }
            //end

            //updating file name after renaming the file and uploading it on the root folder
            $sql = "UPDATE rooms SET images=? WHERE Id = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../admin_rooms.php?roomId=$Id&error=stmt_failed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, 'si', $fileNameNew, $Id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("location: ../admin_edit_room.php?roomId=$Id&error=none");
            exit();
            //end

    //second way of updating the file where the file itself is not being replaced and only the basic infos are being updated
    }else{

        //importing database and functions for validations
        require_once 'dbh-inc.php';
        require_once 'admin-edit-rooms-functions-inc.php';
        //end

        //validating file informations
        if(emptyInput($roomname, $roomrate, $roomdescription) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=emptyinput");
            exit();
        }

        if(invalidRoomName($roomname) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_roomname");
            exit();
        }

        if(invalidRoomRate($roomrate) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_roomrate");
            exit();
        }

        if(invalidDescription($roomdescription) !== false){
            header("location: ../admin_edit_room.php?roomId=$Id&error=invalid_description");
            exit();
        }
        //end

        //updating file informations on database
        editRoom1($conn, $roomname, $roomrate, $roomdescription, $Id);
        //end
        
        header("location: ../admin_edit_room.php?roomId=$Id&error=none");
        exit();

    }

}else{
    header("location: ../admin_rooms.php");
    exit();
}
