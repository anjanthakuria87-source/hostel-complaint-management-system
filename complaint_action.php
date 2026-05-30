<?php
session_start();

include("../configuration/db.php");

// Check login
if (!isset($_SESSION['roll_number'])) {

    header("Location: ../auth/login.php");
    exit();
}

// Fetch session data
$roll_number = $_SESSION['roll_number'];
$hostel_id   = $_SESSION['hostel_id'];

// Form data
$complaint_type = $_POST['complaint_type'];
$comments       = $_POST['comments'];

// Insert query
$sql = "INSERT INTO complaints
        (complaint_type, comments, roll_number, hostel_id)
        VALUES
        ('$complaint_type', '$comments', '$roll_number', '$hostel_id')";

// Execute query
if ($conn->query($sql) === TRUE) {

    echo "
    <script>
        alert('Complaint Submitted Successfully!');
        window.location.href='../status.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Failed to Submit Complaint!');
        window.history.back();
    </script>
    ";
}
?>