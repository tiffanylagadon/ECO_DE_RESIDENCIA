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
      <title>CHANGE PASSWORD | Admin</title>
      <link rel="stylesheet" href="css/styleregister.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
        Change Password
         </div>
            <div class="form">
               <form action="includes/admin-editpassword-inc.php" method="post">
                  <div class="inputfield">
                     <label>Current Password</label>
                     <input type="password" name="password" class="input">
                  </div>  
                  <div class="inputfield">
                     <label>New Password</label>
                     <input type="password" name="npassword" class="input">
                  </div>
                  <div class="inputfield">
                     <label>Confirm New Password</label>
                     <input type="password" name="cnpassword" class="input">
                  </div>
                  <div class="inputfield">
                     <input type="submit" name="submit" value="Save" class="btn">
                  </div>
                     <?php
                        if(isset($_GET["error"])){
                           if ($_GET["error"] == "invalid_currentpassword") {
                              echo "<center><p>Invalid current password!</p></center>";
                           }elseif ($_GET["error"] == "emptyinput") {
                              echo "<center><p>Fill up all fields!</p></center>";
                           }elseif ($_GET["error"] == "invalid_password") {
                              echo "<center><p>Input proper password!</p></center>";
                           }elseif ($_GET["error"] == "password_mismatch") {
                              echo "<center><p>Password mismatch!</p></center>";
                           }elseif ($_GET["error"] == "stmt_failed") {
                              echo "<center><p>Technical error!</p></center>";
                           }elseif ($_GET["error"] == "none") {
                              echo "<center><p>Updated successfully!</p></center>";
                           }
                        }
                     ?>
                      <div class="inputfield">
                      <input type="submit" formaction="admin_editprofile.php" value="Back" class="btn"></div>
               </form>
            </div>
      </div>
   </body>
</html>