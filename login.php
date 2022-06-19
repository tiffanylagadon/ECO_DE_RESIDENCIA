<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>LOGIN | Eco de Residencia</title>
      <link rel="stylesheet" href="css/stylelogin.css">
   </head>
   <body>
      <div class="wrapper2">
         <center><img src="images/logo2.png" width="100px" height="100px"></center> 
         <div class="wrapper">
            <div class="title">
            Login
            </div>
            <form action="includes/user-login-inc.php" method="post">
               <div class="field">
                  <input type="text" name="useremail" required>
                  <label>Email Address</label>
               </div>
               <div class="field">
                  <input type="password" name="password" required>
                  <label>Password</label>
               </div>
               
               <div class="field">
                  <input type="submit" name="submit" value="Login">
               </div>
               <div class="signup-link">
                  Not a member? <a href="register.php">Signup now</a>
                  <?php
                  if(isset($_GET["error"])){
                     if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                     }elseif ($_GET["error"] == "wrongcredentials") {
                        echo "<p>Incorrect email or password!</p>";
                     }
                  }
                  ?>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>