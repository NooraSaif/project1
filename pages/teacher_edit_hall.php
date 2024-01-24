<?php

session_start();

include 'database.php';

if(isset($_POST['submitupdat']))
{
    $booking = mysqli_real_escape_string($con, $_POST['ID']);

    $date = $_POST["date"];
    $Dtype = $_POST["Dtype"];
    $event = $_POST["event"];
    $duration = $_POST["duration"];
    $Stime = $_POST["Stime"];

    $query = "UPDATE bookhall SET date='$date', Dtype='$Dtype', event='$event', duration='$duration', Stime='$Stime' WHERE  ID='$booking' ";
    $query_run = mysqli_query($con, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Booking Updated Successfully";
        header("Location: teacher_history.php");

    }elseif($date) {
        echo "the date you choose is reseved";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bookstyle.css" />
    <title>teacher edit</title>
</head>
<body>
<div class="main">
    <h2>Edite:  </h2>

    <?php
    if(isset($_GET['ID']))
    {
        $booking = mysqli_real_escape_string($con, $_GET['ID']);
        $query = "SELECT * FROM bookhall WHERE ID='$booking' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $booking = mysqli_fetch_array($query_run);
    ?>
            <form action="teacher_edit_hall.php" method="post">
            <input type="hidden" name="ID" value="<?= $booking['ID']; ?>">
            
            <label for="date">date:</label>
            <input id="date" type="date" name="date" value="<?= $booking['date'] ?>" required>
        
            <label for="Dtype">Your Department:</label>
            <select id="Dtype" name="Dtype"  required>
                <option value="<?=$booking['Dtype'];?>"><?=$booking['Dtype'];?></option>
                <option value="mathematics and applied sciences">mathematics and applied sciences</option>
                <option value="Comuting and Electronic Engineering">Comuting and Electronic Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Civil and Mechanical Engineering">Civil and Mechanical Engineering</option>
                <option value="Records Management and Archival Studies">Records Management and Archival Studies</option>
                <option value="Management Studies">Management Studies</option>
                <option value="Foundation Studies">Foundation Studies</option>
            </select>

            <label for="event">Event Type:</label>
            <select id="event" name="event" required>
                <option value="<?= $booking['event']; ?>"><?= $booking['event']; ?></option>
                <option value="lectures">lectures</option>
                <option value="Conference">Conference</option>
                <option value="Professional body meeting">Professional body meeting</option>
                <option value="Student Chapters">Student Chapters</option>
                <option value="Clubs, Societies">Clubs, Societies</option>
            </select>

            <label for="duration">Duration:</label>
            <select id="duration" name="duration" required>
                <option value="<?=$booking['duration']; ?>"><?=$booking['duration']; ?></option>
                <option value="1h">1 hour</option>
                <option value="2h">2 hours</option>
                <option value="3h">3 hours</option>
                <option value="4h">4 hours</option>
                <option value="5h">5 hours</option>
                <option value="6h">6 hours</option>
                <option value="Day">For One Day</option>
            </select>

            <label for="time">Start Time:</label>
            <input id="time" type="time" name="Stime" value="<?= $booking['Stime']; ?>" required>

            <button class="submit" type="submit" name="submitupdat">Update</button>
            </form>
        <?php
        }
        else
        {
            echo "<h4>No Such Id Found</h4>";
        }
    }
    ?>
    </div> 
</body>
</html>