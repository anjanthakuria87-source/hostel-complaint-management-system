<?php
session_start();

include("../configuration/db.php");

// Check login
if (!isset($_SESSION['roll_number'])) {

    header("Location: ../auth/login.php");
    exit();
}

$roll_number = $_SESSION['roll_number'];

// Form data
$name      = $_POST['name'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];
$room_no   = $_POST['room_no'];
$hostel_id = $_POST['hostel_id'];

/*
|--------------------------------------------------------------------------
| Update Profile
|--------------------------------------------------------------------------
*/

$sql = "UPDATE students SET

        name='$name',
        email='$email',
        phone='$phone',
        room_no='$room_no',
        hostel_id='$hostel_id'

        WHERE roll_number='$roll_number'";

// Execute query
if($conn->query($sql) === TRUE) {

    echo "
    <script>
        alert('Profile Updated Successfully!');
        window.location.href='../student_profile.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Failed to Update Profile!');
        window.history.back();
    </script>
    ";
}
?>