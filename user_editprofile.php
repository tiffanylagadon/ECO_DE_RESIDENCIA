<?php
session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>EDIT PROFILE | Eco de Residencia</title>
      <link rel="stylesheet" href="css/styleregister.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
         Edit Profile
         </div>
            <div class="form">
               <form action="includes/user-editprofile-inc.php" method="post">
                  <div class="inputfield">
                     <label>First Name</label>
                     <input type="text" name="fname" class="input" value="<?php echo $_SESSION["usersFname"]; ?>">
                  </div>  
                  <div class="inputfield">
                     <label>Last Name</label>
                     <input type="text" name="lname" class="input" value="<?php echo $_SESSION["usersLname"]; ?>">
                  </div>  
                  <div class="inputfield">
                     <label>Age</label>
                     <input type="text" name="age" class="input" value="<?php echo $_SESSION["usersAge"]; ?>">
                  </div>  
                  <div class="inputfield">
                     <label>Phone Number</label>
                     <input type="text" name="pnumber" class="input" value="<?php echo $_SESSION["usersPnumber"]; ?>">
                  </div> 
                  <div class="inputfield">
                     <label>Address</label>
                     <textarea type="text" name="address" class="textarea"><?php echo $_SESSION["usersAddress"]; ?></textarea>
                  </div> 
                  <div class="inputfield">
                     <label>Gender</label>
                     <div class="custom_select">
                        <select type="text" name="gender" id="gender">
                           <?php
                              if($_SESSION["usersGender"] == "male"){
                                 
                           ?>
                              <option value="">Select</option>
                              <option value="male" selected>Male</option>
                              <option value="female">Female</option>
                           <?php 
                              }else{
                           ?>
                              <option value="">Select</option>
                              <option value="male">Male</option>
                              <option value="female" selected>Female</option>
                           <?php
                              }
                           ?>
                        </select>
                     </div>
                  </div> 
                  <div class="inputfield">
                     <label>Email Address</label>
                     <input type="text" name="email" class="input" value="<?php echo $_SESSION["usersEmail"]; ?>">
                  </div> 
                  <div class="inputfield">
                     <input type="submit" name="submit" value="Save Profile" class="btn">
                  </div>
                     <?php
                        if(isset($_GET["error"])){
                           if($_GET["error"] == "emptyinput"){
                              echo "<center><p>Fill in all fields!</p></center>";
                           }elseif ($_GET["error"] == "invalid_firstname") {
                              echo "<center><p>Input proper first name!</p></center>";
                           }elseif ($_GET["error"] == "invalid_lastname") {
                              echo "<center><p>Input proper last name!</p></center>";
                           }elseif ($_GET["error"] == "invalid_age") {
                              echo "<center><p>minors or too old are not allowed!</p></center>";
                           }elseif ($_GET["error"] == "invalid_phonenumber") {
                              echo "<center><p>Input proper phone number!</p></center>";
                           }elseif ($_GET["error"] == "phonenumber_already_taken") {
                              echo "<center><p>phone number already taken!</p></center>";
                           }elseif ($_GET["error"] == "invalid_email") {
                              echo "<center><p>Input proper email!</p></center>";
                           }elseif ($_GET["error"] == "email_already_taken") {
                              echo "<center><p>Email already taken!</p></center>";
                           }elseif ($_GET["error"] == "invalid_password") {
                              echo "<center><p>Input proper password!</p></center>";
                           }elseif ($_GET["error"] == "password_mismatch") {
                              echo "<center><p>Password mismatch!</p></center>";
                           }elseif ($_GET["error"] == "person_already_exists") {
                              echo "<center><p>This person has already an existing account!</p></center>";
                           }elseif ($_GET["error"] == "stmt_failed") {
                              echo "<center><p>Technical error!</p></center>";
                           }elseif ($_GET["error"] == "none") {
                              echo "<center><p>Updated successfully!</p></center>";
                           }
                        }
                     ?>
                     <div class="inputfield">
                  <input type="submit" formaction="user_editpassword.php" value="Change Password"class="btn"></div>

                  <div class="inputfield">
                  <input type="submit" formaction="myprof.php" value="Back"class="btn"></div>


               </form>
            </div>
      </div>
   </body>
</html>