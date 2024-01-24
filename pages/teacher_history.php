<?php
session_start();

if (!isset($_SESSION['teacher_name'])) {
    header('location: loginpage.php');
}

$userName = $_SESSION['teacher_name'];

include 'database.php';

$stm = $con->prepare("SELECT * FROM bookhall WHERE userName = ?");
$stm->bind_param('s', $userName);

$history = array();
if ($stm->execute()) {
    $result = $stm->get_result();
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    $stm->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/bookstyle.css" />
</head>
<body>
    <div class="header">
        <h1><?php echo $userName; ?> - Booking History</h1>
    </div>
    
    <!-- the evant hall bookings -->
    <div class="main">
    <?php 
    if(isset($_SESSION['message']))
    {

        ?>
        <div class="msgbox">
            <div class="msg"><?php echo $_SESSION['message'];?></div>
            <a href="teacher_history.php" ><i class='bx bxs-tag-x'></i></a>
        </div>
        <?php

        unset($_SESSION['message']);
    }
    ?>
    <div class="landbox">
    <h3>Manage your reservations</h3>
    <button class="back" ><a type="button" href="../pages/teacher_page.php">Back</a></button>
    </div>
    
        <?php if (!empty($history)) : ?>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Department</th>
                    <th>Event Type</th>
                    <th>Duration</th>
                    <th>Start Time</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($history as $booking) : ?>
                    <tr>
                        <td><?php echo $booking['ID']; ?></td>
                        <td><?php echo date('Y/m/d', strtotime($booking['date'])); ?></td>
                        <td><?php echo $booking['Dtype']; ?></td>
                        <td><?php echo $booking['event']; ?></td>
                        <td><?php echo $booking['duration']; ?></td>
                        <td><?php echo $booking['Stime']; ?></td>
                        <td>
                            <div class="modifybox">
                            <button class="edit"><a href="teacher_edit_hall.php?ID=<?=$booking['ID'];?>">Edit</a></button>
                            <form action="cancel_booking.php" method="POST">
                            <button class="cancel" type="submit" name="cancelBooking" value="<?= $booking['ID']; ?>">Cancel</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No bookings found for the Auditoriom!</p>
        <?php endif; ?>
    </div>

    <!-- library rooms bookings -->
    <div class="main">
    <?php 
    if(isset($_SESSION['message']))
    {

        ?>
            <div class="msg"><?php echo $_SESSION['message'];?>
            <a href="teacher_history.php" ><i class='bx bxs-tag-x'></i></a>
        </div>
        <?php

        unset($_SESSION['message']);
    }
    ?>

    <?php 
    $userName = $_SESSION['teacher_name'];

    include 'database.php';

    $stm = $con->prepare("SELECT * FROM bookrooms WHERE userName = ?");
    $stm->bind_param('s', $userName);
    
    $roomHistory = array();
    if ($stm->execute()) {
        $result = $stm->get_result();
        while ($row = $result->fetch_assoc()) {
            $roomHistory[] = $row;
        }
        $stm->close();
    }
    ?>

    <?php if (!empty($roomHistory)) : ?>
        <table>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Room</th>
                <th>No. of persons</th>
                <th>Start Time</th>
                <th>End time</th>
                <th>Action</th>
            </tr>
            <?php foreach ($roomHistory as $bookings) : ?>
                <tr>
                    <td><?php echo $bookings['ID']; ?></td>
                    <td><?php echo $bookings['date']; ?></td>
                    <td><?php echo $bookings['room']; ?></td>
                    <td><?php echo $bookings['persons']; ?></td>
                    <td><?php echo $bookings['Stime']; ?></td>
                    <td><?php echo $bookings['Etime']; ?></td>
                    <td>
                        <div class="modifybox">
                        <button class="edit"><a href="teach_edit_library.php?ID=<?=$bookings['ID'];?>">Edit</a></button>
                        <form action="cancel_booking.php" method="POST">
                        <button class="cancel" type="submit" name="cancelroom" value="<?= $bookings['ID']; ?>">Cancel</button>
                        </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No bookings found for discussion rooms!</p>
    <?php endif; ?>
    </div>
</body>
</html>