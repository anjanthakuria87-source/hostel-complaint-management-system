<?php
session_start();

include("configuration/db.php");

// Check login
if (!isset($_SESSION['roll_number'])) {

    header("Location: auth/login.php");
    exit();
}

// Logged in student
$roll_number = $_SESSION['roll_number'];

/*
|--------------------------------------------------------------------------
| Fetch Student + Hostel Details using JOIN
|--------------------------------------------------------------------------
*/

$sql = "SELECT students.*, hostels.hostel_name
        FROM students
        JOIN hostels
        ON students.hostel_id = hostels.hostel_id
        WHERE students.roll_number = '$roll_number'";

$user = $conn->query($sql)->fetch_assoc();

/*
|--------------------------------------------------------------------------
| Complaint Statistics
|--------------------------------------------------------------------------
*/

$total = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE roll_number='$roll_number'
")->fetch_assoc()['c'];

$pending = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE roll_number='$roll_number'
    AND status='Pending'
")->fetch_assoc()['c'];

$resolved = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE roll_number='$roll_number'
    AND status='Resolved'
")->fetch_assoc()['c'];

$dismissed = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE roll_number='$roll_number'
    AND status='Dismissed'
")->fetch_assoc()['c'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile - HCMS</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        .profile-card {
            background: #f8f9fb;
            padding: 35px;
            border-radius: 18px;
            width: 480px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }

        .profile-icon {
            text-align: center;
            font-size: 70px;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .info-box {
            background: #eef2f7;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .label {
            font-weight: bold;
            color: #1e3c72;
        }

        .value {
            font-weight: bold;
            color: #333;
        }

        /* STATS */

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 25px;
        }

        .stat-box {
            padding: 18px;
            border-radius: 12px;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 15px;
        }

        .stat-box span {
            display: block;
            margin-top: 8px;
            font-size: 24px;
        }

        .total {
            background: #34495e;
        }

        .pending {
            background: orange;
        }

        .resolved {
            background: #27ae60;
        }

        .dismissed {
            background: #e74c3c;
        }

        /* BUTTONS */

        .btn {
            display: block;
            text-align: center;
            padding: 13px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            margin-top: 15px;
        }

        .edit-btn {
            background: #27ae60;
        }

        .edit-btn:hover {
            background: #1f8a4d;
        }

        .back-btn {
            background: #2a5298;
        }

        .back-btn:hover {
            background: #1e3c72;
        }

    </style>
</head>

<body>

<div class="profile-card">

    <div class="profile-icon">👤</div>

    <h2>Student Profile</h2>

    <div class="info-box">
        <span class="label">Roll Number</span>
        <span class="value">
            <?php echo $user['roll_number']; ?>
        </span>
    </div>

    <div class="info-box">
        <span class="label">Full Name</span>
        <span class="value">
            <?php echo $user['name']; ?>
        </span>
    </div>

    <div class="info-box">
        <span class="label">Email</span>
        <span class="value">
            <?php echo $user['email']; ?>
        </span>
    </div>

    <div class="info-box">
        <span class="label">Phone</span>
        <span class="value">
            <?php echo $user['phone']; ?>
        </span>
    </div>

    <div class="info-box">
        <span class="label">Hostel</span>
        <span class="value">
            <?php echo $user['hostel_name']; ?>
        </span>
    </div>

    <div class="info-box">
        <span class="label">Room Number</span>
        <span class="value">
            <?php echo $user['room_no']; ?>
        </span>
    </div>

    <!-- STATS -->

    <div class="stats">

        <div class="stat-box total">
            Total Complaints
            <span><?php echo $total; ?></span>
        </div>

        <div class="stat-box pending">
            Pending
            <span><?php echo $pending; ?></span>
        </div>

        <div class="stat-box resolved">
            Resolved
            <span><?php echo $resolved; ?></span>
        </div>

        <div class="stat-box dismissed">
            Dismissed
            <span><?php echo $dismissed; ?></span>
        </div>

    </div>

    <a href="edit_profile.php" class="btn edit-btn">
        ✏ Edit Profile
    </a>

    <a href="dashboard.php" class="btn back-btn">
        ⬅ Back to Dashboard
    </a>

</div>

</body>
</html>