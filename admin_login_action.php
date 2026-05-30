<?php
session_start();

include("../configuration/db.php");

// Form data
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch admin
$sql = "SELECT * FROM warden_admins
        WHERE email='$email'";

$result = $conn->query($sql);

$admin = $result->fetch_assoc();

// Verify password
if($admin && password_verify($password, $admin['password'])) {

    $_SESSION['admin_id'] = $admin['user_id'];
    $_SESSION['admin_name'] = $admin['name'];
    $_SESSION['hostel_id'] = $admin['hostel_id'];

    echo "
    <script>
        alert('Admin Login Successful!');
        window.location.href='../admin/admin_dashboard.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Invalid Admin ID or Password!');
        window.history.back();
    </script>
    ";
}
?>