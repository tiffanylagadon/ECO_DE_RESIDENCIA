<?php
session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco de Residencia</title>

    <link href="https://fonts.googleapis.com/css?family=Anton|Cabin|Lato|Fjalla+One|Montserrat|Roboto&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <nav>
             <a href="profile.php" class="logo">Eco de Residencia</a><img src="images/logow.png" class="logo" width="50px" height="50px">

 
        <label for="box">
            <span>MENU <i class="fas fa-bars"></i></span>
        </label>

        <ul id="menu">
            <li><a href="profile.php">Home</a></li>
             <li><a href="about_loggedin.php">About us</a></li>
             <li><a href="rooms_loggedin.php">Rooms</a></li>
            <li><a href="contact_loggedin.php">Contact</a></li>
            <li>
            <a href="#"><i class="fas fa-user"></i>  <?php echo $_SESSION["usersFname"]; ?> <i class="fa fa-angle-down"></i></a>
            <ul>
                <li><a href="myprof.php">My Profile</a></li>
                <li><a href="user_editprofile.php">Edit Profile</a></li>
                <li><a href='includes/logout-inc.php'>Logout</a></li>
            </ul>
        </ul>
    </nav>

<br>
<center><h1>CONTACT US</h1></center>
<form action="includes/contact-inc.php" method="post">      
  <input name="name" type="text" class="feedback-input" placeholder="Name">   
  <input name="email" type="text" class="feedback-input" placeholder="Email">
  <textarea name="text" type="text" class="feedback-input" placeholder="Message"></textarea>
  <input type="submit" name="submit" value="SUBMIT">
</form>


 <footer class="footer-distributed">

        <div class="footer-left">
            <h3>Eco de<span>Residencia</span></h3>

            <p class="footer-links">
                <a href="profile.php">Home</a><br>
                <a href="about_loggedin.php">About</a><br>
                <a href="contact_loggedin.php">Contact</a><br>
            </p>

            <p class="footer-company-name">Copyright © 2021 <strong>Eco de Residencia</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Philippines</span>
                    Manila</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>(02) 784053</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="">mail@ecoderesidencia.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>Eco de Residencia</strong> provide high-quality services that support and promote the value of nature in our community. Our hotel offers rooms that are ideal for singles, couples, and families looking for a relaxing and comfortable place where to stay.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>