<?php
session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Add Room</title>
      <link rel="stylesheet" href="css/styleregister.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
            Add Room
         </div>
         <div class="form">
            <form action="includes/admin-add-rooms-inc.php" enctype="multipart/form-data" method="post">
               <div class="inputfield">
                  <label>Upload Picture</label>
                  <input type="file" name="images" class="input" required>
               </div>
               <div class="inputfield">
                  <label>Room Name</label>
                  <input type="text" name="roomname" class="input">
               </div>  
               <div class="inputfield">
                  <label>Rate</label>
                  <input type="text" name="roomrate" class="input">
               </div>  
               <div class="inputfield">
                  <label>Description</label>
                  <input type="text" name="roomdescription" class="input">
               </div>  
               <div class="inputfield">
                  <input type="submit" name="submit" value="Add" class="btn">
               </div>
                  <?php
                  if(isset($_GET["error"])){
                     if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                     }elseif ($_GET["error"] == "invalid_roomname") {
                        echo "<p>Input proper room name!</p>";
                     }elseif ($_GET["error"] == "invalid_roomrate") {
                        echo "<p>Input proper rate!</p>";
                     }elseif ($_GET["error"] == "invalid_description") {
                        echo "<p>Input proper description!</p>";
                     }elseif ($_GET["error"] == "invalidformat") {
                        echo "<p>Input proper photo!</p>";
                     }
                  }
               ?>
               <br/>
            </form>
            <form action="admin_rooms.php">
               <div class="inputfield">
               <input type="submit" value="Back" class="btn"></div>
            </form>
         </div>
      </div>
   </body>
</html>