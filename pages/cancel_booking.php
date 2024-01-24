<!-- Delete teacher bookings for the event hall reservations -->
<?php 
session_start();
include 'database.php';

if(isset($_POST['cancelBooking']))
{
    $booking = mysqli_real_escape_string($con, $_POST['cancelBooking']);

    $query = "DELETE FROM bookhall WHERE ID='$booking' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Booking canceled Successfully";
        header("Location: teacher_history.php");

    }else {
        echo "somthing went wrong";
    }
}
?>

<!-- Delete teacher bookings for the library room reservations -->
<?php 
session_start();
include 'database.php';

if(isset($_POST['cancelroom']))
{
    $bookings = mysqli_real_escape_string($con, $_POST['cancelroom']);

    $query = "DELETE FROM bookrooms WHERE ID='$bookings' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Booking canceled Successfully";
        header("Location: teacher_history.php");

    }else {
        echo "somthing went wrong";
    }
}
?>

<!-- Delete student bookings for the library room reservations -->
<?php 
session_start();
include 'database.php';

if(isset($_POST['cancelstudentroom']))
{
    $rooms = mysqli_real_escape_string($con, $_POST['cancelstudentroom']);

    $query = "DELETE FROM bookrooms WHERE ID='$rooms' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Booking canceled Successfully";
        header("Location: student_history.php");

    }else {
        echo "somthing went wrong";
    }
}
?>