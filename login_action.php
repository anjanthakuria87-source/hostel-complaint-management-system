<?php
session_start();

include("../configuration/db.php");

// Get form data
$roll_no = $_POST['roll_no'];
$password = $_POST['password'];

// Fetch user
$sql = "SELECT * FROM students WHERE roll_number='$roll_no'";

$result = $conn->query($sql);

$user = $result->fetch_assoc();

// Verify password
if ($user && password_verify($password, $user['password'])) {

    // Store session
    $_SESSION['roll_number'] = $user['roll_number'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['hostel_id'] = $user['hostel_id'];

    echo "
    <script>
        alert('Login Successful!');
        window.location.href='../dashboard.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Invalid Roll Number or Password!');
        window.history.back();
    </script>
    ";
}
?>