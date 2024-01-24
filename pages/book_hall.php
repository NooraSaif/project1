<?php

session_start();

if(!isset($_SESSION['teacher_name'])){
   header('location:loginpage.php');
}

$userName = $_SESSION['teacher_name'];

function build_calendar($month, $year){

    include 'database.php';
    $stm = $con->prepare("select * from bookhall where MONTH(date) = ? AND YEAR(date) = ?");
    $stm->bind_param('ss', $month, $year);
    $bookhall = array();
    if($stm->execute()){
        $check = $stm->get_result();
        if($check->num_rows>0){
            while($row = $check->fetch_assoc()){
                $bookhall[] = $row['date'];
            }

            $stm->close();
        }

    }
    

    $Days = array('Sunday', 'Monday', 'Tuseday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    $FDOM = mktime(0,0,0,$month,1,$year);

    $numberDay = date('t', $FDOM);

    $Dates = getdate($FDOM);

    $mName = $Dates['month'];

    $DOW = $Dates['wday'];

    $Today = date('Y-m-d');

    $calendar = "<table>";
    $calendar .= "<center><h2>$mName $year</h2></center>";

    $calendar .= "<tr>";

    foreach($Days as $day) {
        $calendar .= "<th>$day</th>";
   }

   $currentDay = 1;
   $calendar .= "</tr><tr>";

   if ($DOW > 0) { 
    for($k=0;$k<$DOW;$k++){
           $calendar .= "<td  class='empty'></td>"; 

    }
}



$month = str_pad($month, 2, "0", STR_PAD_LEFT);

while ($currentDay <= $numberDay) {

    if ($DOW == 7) {

        $DOW = 0;
        $calendar.= "</tr><tr>";

   }
    
    $Curently = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
    $date = "$year-$month-$Curently";

    $dayNam = strtolower(date('l', strtotime($date)));
    $eventNum = 0;

    $today = $date==date('Y-m-d')? "today" : "";
    if($date<date('Y-m-d')){
        $calendar.="<td><h4>$currentDay</h4> <button class='white'>N/A</button>";
    }elseif(in_array($date, $bookhall)){
        $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='red'>Already Booked</button>";
    }else{
        $calendar.="<td class='$today'><h4>$currentDay</h4> <a class='green' href='book_hall2.php?date=".$date."'>Book</a>";
    }
 
  
    
    $calendar.="</td>";

    $currentDay++;
    $DOW++;

}

if ($DOW != 7) { 
     
    $remainDays = 7 - $DOW;
      for($l=0;$l<$remainDays;$l++){
          $calendar .= "<td class='empty'></td>"; 
   }

}

$calendar .= "</tr>";

$calendar .= "</table>";

echo $calendar;

}

if (isset($_POST["booksubmit"])) {
    $date = $_POST["date"];
    $Dtype = $_POST["Dtype"];
    $event = $_POST["event"];
    $duration = $_POST["duration"];
    $Stime = $_POST["Stime"];

    $userName = $_SESSION['teacher_name'];

    include 'database.php';

    if($stm = $con->prepare("INSERT INTO `bookhall` (`userName`, `date`, `Dtype`, `event`, `duration`, `Stime`) VALUES (?, ?, ?, ?, ?, ?)")){
    $stm->bind_param('ssssss', $userName, $date, $Dtype, $event, $duration, $Stime);
    $stm->execute();
    $msg = "<div class='msg'>Booking Successfull</div>";
    $stm->close();
    }else{
        die('prepare() failed: '.htmlspecialchars($con->error));
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book the auditoriom</title>
    <link rel="stylesheet" href="../css/bookstyle.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="header">
        <h1>The Auditorium - <?php echo $userName; ?></h1>
    </div>

    <!-- calander form -->
    <div class="container-calender">
    <div class="main">
    <?php echo isset($msg)?$msg:''; ?>
    <div class="landbox">
    <h3>Step 1: Check the Available Day:</h3>
    <button class="back" ><a type="button" href="../pages/teacher_page.php">Back</a></button>
    </div>
        <div class="row">
            <div class="calendar">

                <?php 
                $Dates = getdate();
                $month = $Dates['mon']; 			     
                $year = $Dates['year'];
                echo build_calendar($month,$year);
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>