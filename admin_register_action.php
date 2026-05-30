<?php
include("../configuration/db.php");

// Form data
$name      = $_POST['name'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];
$hostel_id = $_POST['hostel_id'];

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

// Insert query
$sql = "INSERT INTO warden_admins

        (name, password, email, phone, hostel_id)

        VALUES

        ('$name', '$password', '$email', '$phone', '$hostel_id')";

// Execute
if($conn->query($sql) === TRUE) {

    echo "
    <script>
        alert('Admin Registered Successfully!');
        window.location.href='../auth/admin_login.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Registration Failed!');
        window.history.back();
    </script>
    ";
}
?>