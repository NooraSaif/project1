<?php

include 'database.php';

session_start();

if(!isset($_SESSION['student_name'])){
   header('location:loginpage.php');
}
$userName = $_SESSION['student_name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>user</title>
  <link rel="stylesheet" href="../css/userstyle.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <!-- Start Header -->
<div class="header" id="header">
  <div class="container">
    <a class="logo">Book EduSpace</a>
    <div class="links">
        <div class="menu"><i class="bx bx-menu-alt-right"></i></div>
        <ul>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </ul>
    </div>
  </div>
</div>
<!-- End Header -->
<!-- Start center -->
<div class="Services" id="Services">
  <div class="text">
    <h2>Hi <?php echo $userName; ?> Book your Education Space Now!</h2>
  </div>
    <div class="container">

      <div class="box">
        <img src="../image/libraryRooms.png" alt="" />
        <div class="content">
          <h3>Discussion Rooms</h3>
          <p>meeting Rooms in the library</p>
        </div>
        <div class="info">
          <button class="button-book"><a href="../pages/student_library.php">Book Now!</a></button>
        </div>
      </div>

      <div class="box">
        <a href="../pages/student_history.php"><img src="../image/h1.jpeg" alt="" /></a>
        <div class="content">
          <h3>My reservation</h3>
          <p>see your booking history <span></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>


