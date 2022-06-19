<?php
session_start();
if(isset($_SESSION["usersFname"])){
    
}else {
    header("location: login.php");
    exit();
}

if(isset($_GET["RoomChoice"])){
    $RoomChoice=$_GET["RoomChoice"];
    $_SESSION["RoomChoice"] = $RoomChoice;

    if ($RoomChoice == "Single"){
        $_SESSION["RoomPrice"] = 800;
    }else if ($RoomChoice == "Double"){
        $_SESSION["RoomPrice"] = 1000;
    }else if ($RoomChoice == "Triple"){
        $_SESSION["RoomPrice"] = 1500;
    }else if ($RoomChoice == "Quad"){
        $_SESSION["RoomPrice"] = 2000;
    }else if ($RoomChoice == "Queen"){
        $_SESSION["RoomPrice"] = 2000;
    }else if ($RoomChoice == "King"){
        $_SESSION["RoomPrice"] = 2500;
    }else if ($RoomChoice == "Honeymoon Suite"){
        $_SESSION["RoomPrice"] = 10000;
    }else if ($RoomChoice == "Sunrise and Sunset Suite"){
        $_SESSION["RoomPrice"] = 8000;
    }else if ($RoomChoice == "Veranda Suite"){
        $_SESSION["RoomPrice"] = 4000;
    }

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
        $namecounter = 1;
        $ratecounter = 1;
        $query1=mysqli_query($conn,"select * from rooms");
        while($row=mysqli_fetch_array($query1)){
            $roomName = $row['roomName'];
            $roomRate = $row['roomRate'];

    ?>
            <p hidden id="roomname<?php echo $namecounter;?>"><?php echo $roomName;?></p>
            <p hidden id="roomrate<?php echo $ratecounter;?>"><?php echo $roomRate;?></p>
    <?php
            $namecounter++;
            $ratecounter++;
        }
    ?>
            <p hidden id="totalroom"><?php echo $roomscount;?></p>


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
    <div class="container-form">
        <form action="includes/book-inc.php" method="post">
                <center><img src="images/logo2.png" width="140px" height="140px"></center> 
            <h2 class="heading heading-yellow"><center>BOOK A ROOM</h2>
            
            <div class="form-field">
                <p>Room</p>
                <div class="custom_select">
                    <select type="text" name="rooms" id="room" required onchange="selectFunction()">

                            <option value="" disabled selected hidden>Please Choose...</option>
                        <?php
                            $optioncounter = 1;
                            $query1=mysqli_query($conn,"select * from rooms");
                            while($row=mysqli_fetch_array($query1)){
                        ?>
                            
                            <option value="<?php echo $optioncounter;?>"><?php echo $row['roomName'];?></option>
                            
                        <?php
                            $optioncounter++;
                            }
                        ?>
                    </select>
                </div>
            </div> 

            <div class="form-field">
                <p>Your Name</p>
                <input type="text" name="clientName" required="true" value=" <?php echo $_SESSION["usersFname"]." ".$_SESSION["usersLname"]; ?> " readonly="true">
            </div>
            <div class="form-field">
                <p>Your email</p>
                <input type="email" name="clientEmail" required="true" value=" <?php echo $_SESSION["usersEmail"] ?> " readonly="true">
            </div>
            <div class="form-field">
                <p>Your number</p>
                <input type="text" name="clientNumber" required="true" value=" <?php echo $_SESSION["usersPnumber"] ?> " readonly="true">
            </div>
            <div class="form-field">
                <p>Check-in Date</p>
                <input type="date" name="checkInDate" required="true" id="dt1" onchange="validatedt1()">
            </div>
            <div class="form-field">
                <p>Check-out Date</p>
                <input type="date" name="checkOutDate" required="true" id="dt2" onchange="validatedt2()">
            </div>
            <div class="form-field">
                <p>Total Amount</p>
                <input type="text" name="totalBill" required="true" id="sampleamount" readonly value="<?php echo $_SESSION["RoomPrice"]; ?>">
            </div>
            <input type="submit" name="submit" value="Submit" class="btnbook">
        </form>
        <?php
            if(isset($_GET["error"])){
                if ($_GET["error"] == "none") {
                    echo "<center><p>Reservation requested!</p></center>";
                }elseif ($_GET["error"] == "schedule_overlapped"){
                    echo "<center><p>Schedule Overlapped!</p></center>";
                }
            }
        ?>
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
<script src="js/booking.js" type="text/javascript"></script>
<?php
    $RoomChoice="";
    $_SESSION["RoomChoice"] = "";
    $_SESSION["RoomPrice"] = "";
?>
</html>