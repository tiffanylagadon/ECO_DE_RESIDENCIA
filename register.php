<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>REGISTER | Eco de Residencia</title>
      <link rel="stylesheet" href="css/styleregister.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
            Registration Form
         </div>
         <div class="form">
            <form action="includes/user-register-inc.php" method="post">
               <div class="inputfield">
                  <label>First Name</label>
                  <input type="text" name="fname" class="input">
               </div>  
               <div class="inputfield">
                  <label>Last Name</label>
                  <input type="text" name="lname" class="input">
               </div>  
               <div class="inputfield">
                  <label>Age</label>
                  <input type="text" name="age" class="input">
               </div>  
               <div class="inputfield">
                  <label>Phone Number</label>
                  <input type="text" name="pnumber" class="input">
               </div> 
               <div class="inputfield">
                  <label>Address</label>
                  <textarea type="text" name="address" class="textarea"></textarea>
               </div> 
               <div class="inputfield">
                  <label>Gender</label>
                  <div class="custom_select">
                     <select type="text" name="gender" id="gender">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                  </div>
               </div> 
               <div class="inputfield">
                  <label>Email Address</label>
                  <input type="text" name="email" class="input">
               </div> 
               <div class="inputfield">
                  <label>Password</label>
                  <input type="password" name="password" class="input">
               </div>  
               <div class="inputfield">
                  <label>Confirm Password</label>
                  <input type="password" name="cpassword" class="input">
               </div> 
               
               <div class="inputfield">
                  <input type="submit" name="submit" value="Register" class="btn"></div>
                 <div class="inputfield">
                  <input type="submit" formaction="login.php" value="Login"class="btn"></div>
                  <?php
                     if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                           echo "<p>Fill in all fields!</p>";
                        }elseif ($_GET["error"] == "invalid_firstname") {
                           echo "<p>Input proper first name!</p>";
                        }elseif ($_GET["error"] == "invalid_lastname") {
                           echo "<p>Input proper last name!</p>";
                        }elseif ($_GET["error"] == "invalid_age") {
                           echo "<p>minors or too old are not allowed!</p>";
                        }elseif ($_GET["error"] == "invalid_phonenumber") {
                           echo "<p>Input proper phone number!</p>";
                        }elseif ($_GET["error"] == "phonenumber_already_taken") {
                           echo "<p>phone number already taken!</p>";
                        }elseif ($_GET["error"] == "invalid_email") {
                           echo "<p>Input proper email!</p>";
                        }elseif ($_GET["error"] == "email_already_taken") {
                           echo "<p>Email already taken!</p>";
                        }elseif ($_GET["error"] == "invalid_password") {
                           echo "<p>Input proper password!</p>";
                        }elseif ($_GET["error"] == "password_mismatch") {
                           echo "<p>Password mismatch!</p>";
                        }elseif ($_GET["error"] == "person_already_exists") {
                           echo "<p>This person has already an existing account!</p>";
                        }elseif ($_GET["error"] == "stmt_failed") {
                           echo "<p>Technical error!</p>";
                        }elseif ($_GET["error"] == "none") {
                           echo "<center><p>Registered successfully!</p></center>";
                        }
                     }
                  ?>
            </form>
         </div>
      </div>
   </body>
</html>