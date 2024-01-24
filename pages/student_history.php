<?php 

session_start();
    
if (!isset($_SESSION['student_name'])) {
    header('location: loginpage.php');
}
$userName = $_SESSION['student_name'];

include 'database.php';

$stm = $con->prepare("SELECT * FROM bookrooms WHERE userName = ?");
$stm->bind_param('s', $userName);
    
$studentHistory = array();
if ($stm->execute()) {
    $check = $stm->get_result();
    while ($row = $check->fetch_assoc()) {
        $studentHistory[] = $row;
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

    <div class="main">
    <?php 
    if(isset($_SESSION['message']))
    {
        ?>
        <div class="msgbox">
            <div class="msg"><?php echo $_SESSION['message'];?></div>
            <a href="student_history.php" ><i class='bx bxs-tag-x'></i></a>
        </div>
        <?php
        unset($_SESSION['message']);
    }
    ?>
    <div class="landbox">
    <h3>Manage your reservations</h3>
    <button class="back" ><a type="button" href="../pages/student_page.php">Back</a></button>
    </div>

    <?php if (!empty($studentHistory)) : ?>
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
            <?php foreach ($studentHistory as $rooms) : ?>
                <tr>
                    <td><?php echo $rooms['ID']; ?></td>
                    <td><?php echo $rooms['date']; ?></td>
                    <td><?php echo $rooms['room']; ?></td>
                    <td><?php echo $rooms['persons']; ?></td>
                    <td><?php echo $rooms['Stime']; ?></td>
                    <td><?php echo $rooms['Etime']; ?></td>
                    <td>
                        <div class="modifybox">
                        <button class="edit"><a href="student_edit.php?ID=<?=$rooms['ID'];?>">Edit</a></button>
                        <form action="cancel_booking.php" method="POST">
                        <button class="cancel" type="submit" name="cancelstudentroom" value="<?= $rooms['ID']; ?>">Cancel</button>
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