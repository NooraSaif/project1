<?php

include 'database.php';

session_start();

if (!isset($_SESSION['teacher_name'])) {
    header('location: loginpage.php');
}

$userName = $_SESSION['teacher_name'];


if (isset($_POST["Confirm"])) {
    $date = $_POST["date"];
    $room = $_POST["room"];
    $persons = $_POST["persons"];
    $Stime = $_POST["Stime"];
    $duration = $_POST["duration"];

    $userName = $_SESSION['teacher_name'];

    if($stmt = $con->prepare("INSERT INTO `bookRooms` (`userName`, `date`, `room`, `persons`, `Stime`, `duration`, `Etime`) VALUES (?, ?, ?, ?, ?, ?, ?)")){
    $stmt->bind_param('sssssss', $userName, $date, $room, $persons, $Stime, $duration, $Etime);
    $start = strtotime($Stime);
        $end = $start + ($duration * 60);
        $Etime = date('H:i', $end);
        $stmt->execute();
        $msg = "<div class='msg'>Booking Successful</div>";
        $stmt->close();
    } else {
        die("somthing went wrong!");
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bookstyle.css"/>
    <title>library Room booking</title>
</head>
<body>

    <div class="header">
        <h1>Discussion Rooms</h1>
    </div>

    <div class="main">
    <?php echo isset($msg)?$msg:''; ?>
    <div class="landbox">
    <h3>Reserve a Discussion Room and Meet with your Students! </h3>
    <button class="back" ><a type="button" href="../pages/teacher_page.php">Back</a></button>
    </div>
        <form id="bookingForm" action="teacher_library.php" method="POST">

            <label for="date">Select Date: (only for this week)</label>
            <input id="date" type="date" name="date" required>

            <label for="room">Select Room:</label>
            <select id="room" name="room" required>
                <option value="">--Select Room--</option>
                <option value="room1">Room 1</option>
                <option value="room2">Room 2</option>
                <option value="room3">Room 3</option>
                <option value="room4">Room 4</option>
                <option value="room5">Room 5</option>
            </select>

            <label for="persons">Number of Persons:</label>
            <select id="persons" name="persons" required>
                <option value="">--Select No.--</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="8">9</option>
                <option value="8">10</option>
            </select>

            <label for="Stime">start time:</label>
            <input  id="Stime" type="time" name="Stime" required>

            <label for="duration">duration:</label>
            <select id="duration" name="duration" required>
                <option value="">--Select No.--</option>
                <option value="30">30 min</option>
                <option value="60">1h</option>
                <option value="120">1h and 30min</option>
            </select>

            <button class="submit" type="submit" name="Confirm">Confirm Booking</button>

        </form>
    </div>

</body>
</html>
