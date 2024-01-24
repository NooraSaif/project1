<?php

session_start();

include 'database.php';

if(isset($_POST['submiteUpdate']))
{
    $rooms = mysqli_real_escape_string($con, $_POST['ID']);

    $date = $_POST["date"];
    $room = $_POST["room"];
    $persons = $_POST["persons"];
    $Stime = $_POST["Stime"];
    $Etime = $_POST["Etime"];

    $query = "UPDATE bookrooms SET date='$date', room='$room', persons='$persons',  Stime='$Stime', Etime='$Etime' WHERE  ID='$rooms' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Booking Updated Successfully";
        header("Location: student_history.php");

    }else {
        echo "somthing went wrong";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bookstyle.css"/>
    <title>Room Booking System</title>
</head>
<body>

    <div class="header">
        <h1>library rooms</h1>
    </div>

    <div class="main">
    <?php echo isset($msg)?$msg:''; ?>
        <h2> edite</h2>
        <?php
    if(isset($_GET['ID']))
    {
        $rooms = mysqli_real_escape_string($con, $_GET['ID']);
        $query = "SELECT * FROM bookrooms WHERE ID='$rooms' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $rooms = mysqli_fetch_array($query_run);
    ?>
        <form action="student_edit.php" method="POST">
        <input type="hidden" name="ID" value="<?= $rooms['ID']; ?>">

            <label for="date">Select Date (only for this week):</label>
            <input id="date" type="date" name="date" value="<?= $rooms['date']; ?>">

            <label for="room">Select Room:</label>
            <select id="room" name="room" required>
                <option value="<?= $rooms['room']; ?>"><?= $rooms['room']; ?></option>
                <option value="room1">Room 1</option>
                <option value="room2">Room 2</option>
                <option value="room3">Room 3</option>
                <option value="room3">Room 4</option>
                <option value="room3">Room 5</option>
            </select>

            <label for="persons">Number of Persons:</label>
            <select id="persons" name="persons" required>
                <option value="<?= $rooms['persons']; ?>"><?= $rooms['persons']; ?></option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label for="Stime">start time:</label>
            <input  id="Stime" type="time" name="Stime" value="<?= $rooms['Stime']; ?>">

            <label for="Etime">End time:</label>
            <input  id="Etime" type="time" name="Etime" value="<?= $rooms['Etime']; ?>">

            <button class="submit" type="submit" name="submiteUpdate">Update</button>

        </form>
        <?php
        }
        else
        {
            echo "<h4>No bookings Found</h4>";
        }
    }
    ?>
    </div>

</body>
</html>
