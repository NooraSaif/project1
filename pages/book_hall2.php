<?php

if(isset($_GET['date'])){
    $date = $_GET['date'];
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
    <div class="container-details">
    <div class="main">
    <div class="landbox">
    <h3>Step 2:  Fill The Details:</h3>
    <button class="back" ><a type="button" href="../pages/book_hall.php">Back</a></button>
    </div>
    <h2>Book for Date: <?php echo date('Y/m/d', strtotime($date)); ?> </h2>

        <form action="book_hall.php" method="post">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <label for="Dtype">Your Department:</label>
            <select id="Dtype" name="Dtype" required>
                <option value="">-- Select Department Type --</option>
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
                <option value="">-- Select Event Type --</option>
                <option value="lectures">lectures</option>
                <option value="Conference">Conference</option>
                <option value="Professional body meeting">Professional body meeting</option>
                <option value="Student Chapters">Student Chapters</option>
                <option value="Clubs, Societies">Clubs, Societies</option>
            </select>

            <label for="duration">Duration:</label>
            <select id="duration" name="duration" required>
                <option value="1h">1 hour</option>
                <option value="2h">2 hours</option>
                <option value="3h">3 hours</option>
                <option value="4h">4 hours</option>
                <option value="5h">5 hours</option>
                <option value="6h">6 hours</option>
                <option value="Day">For One Day</option>
            </select>

            <label for="time">Start Time:</label>
            <input type="time" id="time" name="Stime" required>

            <button class="submit" type="submit" name="booksubmit">Confirm Booking</button>
        </form>
    </div> 
    </div>
</body>
</html>