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
      <title>Edit Room</title>
      <link rel="stylesheet" href="css/styleregister.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
            Edit Room
         </div>
         <?php
         
            $Id = $_GET["roomId"];
            require_once 'includes/dbh-inc.php';
            $querytogetselectedinfo=mysqli_query($conn,"select * from rooms where Id = $Id");
            while($row=mysqli_fetch_array($querytogetselectedinfo))
            { 
               $_SESSION["roomId"] = $row['Id'];
               $roomName = $row['roomName'];
               $roomRate = $row['roomRate'];
               $roomDescription = $row['roomDescription'];
            }
         ?>
         <div class="form">
            <form action="includes/admin-edit-rooms-inc.php" enctype="multipart/form-data" method="post">
               <div class="inputfield">
                  <label>Upload Picture</label>
                  <input type="file" name="images" class="input">
               </div>
               <div class="inputfield">
                  <label>Room Name</label>
                  <input type="text" name="roomname" class="input" value="<?php echo $roomName; ?>">
               </div>  
               <div class="inputfield">
                  <label>Rate</label>
                  <input type="text" name="roomrate" class="input" value="<?php echo $roomRate; ?>">
               </div>  
               <div class="inputfield">
                  <label>Description</label>
                  <input type="text" name="roomdescription" class="input" value="<?php echo $roomDescription; ?>">
               </div>  
               <div class="inputfield">
                  <input type="submit" name="submit" value="Edit" class="btn">
               </div>
               <?php
                  if(isset($_GET["error"])){
                     if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                     }elseif ($_GET["error"] == "invalid_roomname") {
                        echo "<p>Input proper room name!</p>";
                     }elseif ($_GET["error"] == "invalid_roomrate") {
                        echo "<p>Input proper rate not less than 800!</p>";
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
                      <input type="submit" value="Back" class="btn">
                  </div>
               </form>
         </div>
      </div>
   </body>
</html>