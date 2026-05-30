<?php
session_start();

include("../configuration/db.php");

/*
|--------------------------------------------------------------------------
| Check Admin Authentication
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['admin_id'])) {

    header("Location: ../admin/admin_login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Validate Inputs
|--------------------------------------------------------------------------
*/

if (
    !isset($_GET['id']) ||
    !isset($_GET['status'])
) {

    header("Location: ../admin/admin_dashboard.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

/*
|--------------------------------------------------------------------------
| Allowed Status Values
|--------------------------------------------------------------------------
*/

$allowed_status = [
    "pending",
    "resolved",
    "dismissed"
];

/*
|--------------------------------------------------------------------------
| Prevent Invalid Status
|--------------------------------------------------------------------------
*/

if (!in_array($status, $allowed_status)) {

    echo "
    <script>
        alert('Invalid Status!');
        window.history.back();
    </script>
    ";

    exit();
}

/*
|--------------------------------------------------------------------------
| Update Complaint Status
|--------------------------------------------------------------------------
*/

$sql = "UPDATE complaints
        SET status='$status'
        WHERE complaint_id='$id'";

/*
|--------------------------------------------------------------------------
| Execute Query
|--------------------------------------------------------------------------
*/

if($conn->query($sql) === TRUE) {

    echo "
    <script>
        alert('Complaint Status Updated!');
        window.location.href='../admin/admin_dashboard.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Failed to Update Status!');
        window.history.back();
    </script>
    ";
}
?>