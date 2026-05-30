<?php
include("../configuration/db.php");

// Get form data
$roll_number = $_POST['roll_number'];
$name        = $_POST['name'];
$email       = $_POST['email'];
$phone       = $_POST['phone'];
$room_no     = $_POST['room_no'];
$hostel_id   = $_POST['hostel_id'];

// Hash password
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Correct SQL query
$sql = "INSERT INTO students 
        (roll_number, name, email, phone, room_no, hostel_id, password)
        VALUES
        ('$roll_number', '$name', '$email', '$phone', '$room_no', '$hostel_id', '$password')";

// Execute query
if ($conn->query($sql) === TRUE) {

    echo "
    <script>
        alert('Registration Successful!');
        window.location.href='../auth/login.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Error: " . $conn->error . "');
        window.history.back();
    </script>
    ";
}
?>