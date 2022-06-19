<?php
session_start();
if(isset($_SESSION["adminFname"])){
    
}else {
    header("location: admin.php");
    exit();
}

//importing database
require_once 'includes/dbh-inc.php';

//getting total registered users
$sql = "SELECT COUNT(*) as num FROM users;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $registeredUsers = $row['num'];
}else {
    $registeredUsers = 0;
}
//end

//getting total registered admins
$sql = "SELECT COUNT(*) as num FROM admin;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $registeredAdmins = $row['num'];
}else {
    $registeredAdmins = 0;
}
//end

//getting total number of rooms
$sql = "SELECT COUNT(*) as num FROM rooms;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $totalRooms = $row['num'];
}else {
    $totalRooms = 0;
}
//end

//getting transactions for this month
$month = date('m');
$sql = "SELECT COUNT(*) as num FROM history where Month(checkInDate) = '$month' and transtatus <> 'cancelled';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $transthisMonth = $row['num'];
}else {
    $transthisMonth = 0;
}
//end

//getting overall transactions
$sql = "SELECT COUNT(*) as num FROM history where transtatus <> 'cancelled';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $overalltrans = $row['num'];
}else {
    $overalltrans = 0;
}
//end

//getting cancelled transactions
$sql = "SELECT COUNT(*) as num FROM history where transtatus = 'cancelled';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $cancelledtrans = $row['num'];
}else {
    $cancelledtrans = 0;
}
//end

//getting All time total earnings
$sql = "SELECT SUM(totalBill) as num FROM history where transtatus <> 'cancelled';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $totalearnings = $row['num'];
}else {
    $totalearnings = 0;
}
//end

//getting earnings this month
$month = date('m');
$sql = "SELECT SUM(totalBill) as num FROM history where Month(checkInDate) = '$month' and transtatus <> 'cancelled';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $monthlyearnings = $row['num'];
}else {
    $monthlyearnings = 0;
}
//end

//getting ongoing reservations
$sql = "SELECT COUNT(*) as num FROM reservations;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location:admin-analytics.php?error=stmt_failed");
    exit();
}
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($resultData)){
    $ongoingreservations = $row['num'];
}else {
    $ongoingreservations = 0;
}
//end


?>
<html>
<head>
<title>Analytics</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco de Residencia</title>

    <link href="https://fonts.googleapis.com/css?family=Anton|Cabin|Lato|Fjalla+One|Montserrat|Roboto&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">

    <style>
        .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
    </style>

</head>
    <body>
    <h1 style="text-align:center; color:#CC3300;" >Analytics</h1>
        <div class="container">
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Registered Users
                    </div>
                    <p>
                    <?php echo $registeredUsers; //printing total registered users ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Registered Admins
                    </div>
                    <p>
                    <?php echo $registeredAdmins; //printing total registered admins ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Total Rooms
                    </div>
                    <p>
                    <?php echo $totalRooms; //printing total rooms ?>
                    </p>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Transactions this month
                    </div>
                    <p>
                    <?php echo $transthisMonth; //printing total Successful Transactions this month ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Overall Transactions
                    </div>
                    <p>
                    <?php echo $overalltrans; //printing overall transactions ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Cancelled Transactions
                    </div>
                    <p>
                    <?php echo $cancelledtrans; //printing cancelled transactions ?>
                    </p>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        All time earnings
                    </div>
                    <p>
                    <?php echo $totalearnings; //printing all time total earnings ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Earnings this month
                    </div>
                    <p>
                    <?php echo $monthlyearnings; //printing overall transactions ?>
                    </p>
                </div>
            </div>
            <div class="room">
                <div class="img">
                    <img src="images/1.jpg">
                </div>
                <div class="top-text">
                    <div class="name">
                        Current Reservations
                    </div>
                    <p>
                    <?php echo $ongoingreservations; //printing cancelled transactions ?>
                    </p>
                </div>
            </div>
        </div>
        <center><a href="dashboard.php"><button class="button button5">Back</button></a></center>
    </body>
</html>
