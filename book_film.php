<?php
session_start();



include 'connect.php';

if (isset($_POST['book_film'])) {

    $user_id = $_SESSION['user_id'];
    $film_id = $_POST['film_id'];
    $booking_date = $_POST['booking_date'];
    $sql = "INSERT INTO booking (user_id, film_id, booking_date) VALUES ('$user_id', '$film_id', '$booking_date')";

    if (mysqli_query($conn, $sql)) {
        echo "Booking successful!";
    } else {
        echo "<script>window.location.href='login.php';</script>";
        echo "Booking failed!";
    }
}
?>