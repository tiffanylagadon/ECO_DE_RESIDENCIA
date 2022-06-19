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
  <a href="home.php" class="logo">Eco de Residencia</a><img src="images/logow.png" class="logo" width="50px" height="50px">

  
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
    <center><h1 style="color:#2B463C;">Rooms</h1></center>

      <?php
         require_once 'includes/dbh-inc.php';
         //getting total rooms
         $sql = "SELECT COUNT(*) as num FROM rooms;";
         $stmt = mysqli_stmt_init($conn);
         if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location:admin-analytics.php?error=stmt_failed");
            exit();
         }
         mysqli_stmt_execute($stmt);
         $resultData = mysqli_stmt_get_result($stmt);

         if($row = mysqli_fetch_assoc($resultData)){
            $roomscount = $row['num'];
         }else {
            $roomscount = 0;
         }
         //end
         $counter = 1;
         $indicator = 1;
         $query1=mysqli_query($conn,"select * from rooms");
         while($row=mysqli_fetch_array($query1)){
            if($counter == $roomscount && $indicator == 1){
      ?>
            <div class="lroom">
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
                     <div class="text">
                        <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
                  </div>
               </div>
            </div>
      <?php
            }elseif($indicator == 1){
      ?>
            <div class="container">
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
                        <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
               </div>
      <?php
            }elseif($counter == $roomscount && $indicator == 2){
      ?>
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
              
                        <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
            </div>
      <?php
            }elseif($indicator == 2){
      ?>
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
                        <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
               </div>
      <?php
            }elseif($indicator == 3){
      ?>
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
                     <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
                  </div>
               </div>
            </div>
            <br>

            <?php
            }elseif($indicator == 3){
      ?>
               <div class="lroom">
                  <div class="img">
                     <img src='uploads/<?php echo $row['images']; ?>'>
                  </div>
                  <div class="rname">
                     <div class="name">
                        <?php echo $row['roomName']; ?>
                     </div>
                     <p>
                        <?php echo $row['roomRate']; ?> per night
                     </p>
                  </div>
                  <div class="lrdesc">
                     <?php echo $row['roomDescription']; ?>
                     </div>
                     <div class="lrbtn">
                        <a href="book_loggedin.php">Book Now</a>
                     </div>
                  </div>
               </div>
            </div>
            <br>

            


      <?php
            }

            if($indicator == 1){
               $indicator = 2;
            }elseif($indicator == 2){
               $indicator = 3;
            }else{
               $indicator = 1;
            }
            $counter++;
         }
      ?>
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