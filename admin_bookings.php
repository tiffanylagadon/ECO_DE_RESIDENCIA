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
  <meta charset="UTF-8">
  <title> Bookings </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="css/stylebookings.css">
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
    <h1>BOOKINGS</h1>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
          <thead>
            <tr>
              <th><center>Room</center></th>
              <th><center>Name</center></th>
              <th><center>Email</center></th>
              <th><center>Phone</center></th>
              <th><center>Check-in Date</center></th>
              <th><center>Check-out Date</center></th>
              <th><center>Total Bill</center></th>
              <th><center>Operation</th>
              <th><center>Cancel</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require_once 'includes/dbh-inc.php';
              $query1=mysqli_query($conn,"select * from reservations");
              while($row=mysqli_fetch_array($query1)){ 
                  $Id = $row['Id'];
                  $occupied = $row['occupied'];
            ?>
              <tr>
                <td><center><?php echo $row['room']; ?></center></td>
                <td><center><?php echo $row['clientName']; ?></center></td>
                <td><center><?php echo $row['clientEmail']; ?></center></td>
                <td><center><?php echo $row['clientNumber']; ?></center></td>
                <td><center><?php echo $row['checkInDate']; ?></center></td>
                <td><center><?php echo $row['checkOutDate']; ?></center></td>
                <td><center><?php echo $row['totalBill']; ?></center></td>
                <?php
                  if($occupied == 0){
                ?>   
                  <td><center><a href="includes/checkin-booking-inc.php?checkinId=<?php echo $Id; ?>"><button class="button">Check-in</button></a></center></td>
                <?php
                  }else{
                ?>
                  <td><center><a href="includes/checkout-booking-inc.php?checkoutId=<?php echo $Id; ?>"><button class="button">Check-out</button></a></center></td>
                <?php } ?>
                  <td><center><a href="includes/cancel-booking-inc.php?cancelId=<?php echo $Id; ?>"><button class="button">Cancel</button></a></center></td>
              </tr>
            <?php } ?>     
          </tbody>
        </table>
      </div>
      <center><a href="dashboard.php"><button class="button">Back</button></a></center>
    </div>
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
