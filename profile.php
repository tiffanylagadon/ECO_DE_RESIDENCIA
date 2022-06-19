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
    <link rel="stylesheet" href="style.css">
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
            </li>
        </ul>
    </nav>

    <div class="slider">
        <input type="radio" name="slide" id="slide-1" checked>
        <input type="radio" name="slide" id="slide-2">
        <input type="radio" name="slide" id="slide-3">

        <div class="slides">
            <div class="slide slide-1">
                <div class="slide-data">
                    <h1>Welcome to Eco de Residencia</h1>
                    <P>Eco De Residencia provide high-quality services that support and promote the value of nature in our community. </P>
    <button><a href="book_loggedin.php">BOOK NOW</a></button>
                </div>
            </div>
            <div class="slide slide-2">
                <div class="slide-data">
                    <h1>Welcome to Eco de Residencia</h1>
                    <P>Eco De Residencia provide high-quality services that support and promote the value of nature in our community. </P>
                    <button><a href="book_loggedin.php">BOOK NOW</a></button>
                </div>
            </div>
            <div class="slide slide-3">
                <div class="slide-data">
                    <h1>Welcome to Eco de Residencia</h1>
                    <P>Eco De Residencia provide high-quality services that support and promote the value of nature in our community. </P>
                    <button><a href="book_loggedin.php">BOOK NOW</a></button>
       
                </div>
            </div>
        </div>



        <div class="arrows arrow-left">
            <label for="slide-3">
                <span><i class="fas fa-angle-left"></i></span>
            </label>
            <label for="slide-1">
                <span><i class="fas fa-angle-left"></i></span>
            </label>
            <label for="slide-2">
                <span><i class="fas fa-angle-left"></i></span>
            </label>
        </div>

        <div class="arrows arrow-right">
            <label for="slide-2">
                <span><i class="fas fa-angle-right"></i></span>
            </label>
            <label for="slide-3">
                <span><i class="fas fa-angle-right"></i></span>
            </label>
            <label for="slide-1">
                <span><i class="fas fa-angle-right"></i></span>
            </label>
        </div>

        <div class="dots">
            <label for="slide-1"></label>
            <label for="slide-2"></label>
            <label for="slide-3"></label>
        </div>
    </div>

 <div class="about">
        <div class="inner-section">
            <h1>About Us</h1>
            <p class="text">
               Eco De Residencia provide high-quality services that support and promote the value of nature in our community. Our hotel offers rooms that are ideal for singles, couples, and families looking for a relaxing and comfortable place where to stay.
            </p>
            <div class="skills">
                <button><a href="about_loggedin.php" style="text-decoration: none; color:#2B463C;">Read More</a></button>
            </div>
        </div>
    </div>

  <div class="services">
        <div class="max-width">
            <h1>Our Services</h1>
            <div class="content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-comments"></i></i>
                        <h3>24/7 Customer Service</h3>
                        <p>Get help as soon as possible! Our 24/7 customer care guarantees that you get the help and support you need, whenever and wherever you need it.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-money-check-alt"></i>
                        <h3>Secure & Flexible Payment Methods</h3>
                        <p>There's no need to worry if you don't have a credit card. Debit cards, bank counters, 7-Eleven, and pawnshops are all accepted methods of payment.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-smile"></i>
                        <h3>Real Reviews from our Guests</h3>
                        <p>More than 100,000+ verified ratings from our loyal customers will assist you in booking the ideal accommodation and will give tips for your perfect vacation.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-percent"></i>
                        <h3>Promos and Discounts</h3>
                        <p>Stay updated to know the latest deals and big discounts! Big surprises means big promos! Get the best room mates for you and a discount up to 30% off!</p>
                    </div>
                </div>
            </div>
        </div> </div>
   <center><h1>Featured Rooms</h1></center>
    <div class="container">
         <div class="room">
            <div class="img">
               <img src="imgroom/s2.jpg">
            </div>
            <div class="top-text">
               <div class="name">
                  Solo
               </div>
               <p>
                  P1,137 per night
               </p>
            </div>
            <div class="bottom-text">
               <div class="text">
                  It's a cozy and suitable room for one person, perfect for a business trip. In our special single room, you will find comfort, light, and silence.
               </div>
               <div class="btn">
                  <a href="book_loggedin.php" target="_blank">Book Now</a>
               </div>
            </div>
         </div>
         <div class="room">
            <div class="img">
               <img src="imgroom/d2.jpeg">
            </div>
            <div class="top-text">
               <div class="name">
                Rested Nights
               </div>
               <p>
                  P5,300 per night
               </p>
            </div>
            <div class="bottom-text">
               <div class="text">
                 This double bed bedroom is the classic double bed with stylish design for all people good for resting and comfy for sleep. A great place to relax and unwind.
               </div>
               <div class="btn">
                  <a href="book_loggedin.php" target="_blank">Book Now</a>
               </div>
            </div>
         </div>
         <div class="room">
            <div class="img">
               <img src="imgroom/c1.jpg">
            </div>
            <div class="top-text">
               <div class="name">
                  Adam's Ale
               </div>
               <p>
                  P9,500 per night
               </p>
            </div>
            <div class="bottom-text">
               <div class="text">
                  Enjoy a relaxing stay and feel the stresses of the day melt away beside the pool area. Perfect for summer and relaxing. This is your perfect summer getaway with yourself or family.
               </div>
               <div class="btn">
                  <a href="book_loggedin.php" target="_blank">Book Now</a>
               </div>
            </div>
         </div>
      </div>

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