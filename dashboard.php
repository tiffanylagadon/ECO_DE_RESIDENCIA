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

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title> Dashboard </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="css/styledash.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-user-circle icon'></i>
      <div class="logo_name">ECO DE RESIDENCIA</div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">

      <li>
        <a href="dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
          <span class="tooltip">Dashboard</span>
      </li>

      <li>
        <a href="admin_rooms.php">
          <i class='bx bx-bed'></i>
          <span class="links_name">Rooms</span>
        </a>
          <span class="tooltip">Rooms</span>
      </li>

      <li>
        <a href="admin_bookings.php">
          <i class='bx bx-cart-alt' ></i>
          <span class="links_name">Bookings</span>
        </a>
          <span class="tooltip">Bookings</span>
      </li>

      <li>
        <a href="admin_history.php">
          <i class='bx bx-history'></i>
          <span class="links_name">History</span>
        </a>
          <span class="tooltip">History</span>
      </li>

      <li>
        <a href="admin-messages.php">
          <i class='bx bx-chat' ></i>
          <span class="links_name">Messages</span>
        </a>
          <span class="tooltip">Messages</span>
      </li>

      <li>
        <a href="adminregistration.php">
          <i class='bx bx-plus' ></i>
          <span class="links_name">Add Admin</span>
        </a>
          <span class="tooltip">Add Admin</span>
      </li>

      <li>
        <a href="admin_editprofile.php">
          <i class='bx bx-cog' ></i>
          <span class="links_name">Setting</span>
        </a>
          <span class="tooltip">Setting</span>
      </li>

      <li class="profile">
        <div class="profile-details">
          <img src="images/0.png" alt="profileImg">
          <div class="name_job">
            <div class="name"><?php echo $_SESSION["adminFname"]; ?></div>
            <div class="job">Admin</div>
          </div>
        </div>
        <a href='includes/admin-logout-inc.php'><i class='bx bx-log-out' id="log_out" ></i></a>
      </li>
    </ul>
  </div>

  <section class="home-section">
    <div class="text"></div>
    <h1>DASHBOARD</h1>

    <div class="row">

      <div class="column">
        <div class="card">
          <h3>Registered Users</h3>
          <p><?php echo $registeredUsers; //printing total registered users ?></p>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <h3>Registered Admins</h3>
          <p><?php echo $registeredAdmins; //printing total registered admins ?></p>
        </div>
      </div>
      
      <div class="column">
        <div class="card">
          <h3>Total Rooms</h3>
          <p><?php echo $totalRooms; //printing total rooms ?></p>
        </div>
      </div>

    </div><br>

    <div class="row">

      <div class="column">
        <div class="card">
          <h3>Transactions this month</h3>
          <p><?php echo $transthisMonth; //printing total Successful Transactions this month ?></p>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <h3>Overall Transactions</h3>
          <p><?php echo $overalltrans; //printing overall transactions ?></p>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <h3>Cancelled Transactions</h3>
          <p><?php echo $cancelledtrans; //printing cancelled transactions ?></p>
        </div> 
      </div>
      
    </div><br>

    <div class="row">

      <div class="column">
        <div class="card">
          <h3>Current Reservations</h3>
          <p><?php echo $ongoingreservations; //printing cancelled transactions ?></p>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <h3>Earnings this month</h3>
          <p><?php echo $monthlyearnings; //printing overall transactions ?></p>
        </div>
      </div>
      
      <div class="column">
        <div class="card">
          <h3>All time earnings</h3>
          <p><?php echo $totalearnings; //printing all time total earnings ?></p>
        </div>
      </div>  
    </div><br>

  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function
    });

    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function
    });

    // following are the code to change sidebar button
    function menuBtnChange() {
      if(sidebar.classList.contains("open")){
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the icons class
      }else {
        closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the icons class
      }
    }
  </script>

</body>
</html>
