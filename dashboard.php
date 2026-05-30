<?php
session_start();

if (!isset($_SESSION['roll_number'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - HCMS</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .container {
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 250px;
            padding: 25px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .complaint {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
        }

        .status {
            background: linear-gradient(135deg, #43cea2, #185a9d);
        }

        .profile {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .card h3 {
            margin: 0;
        }

        .card p {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<?php include("components/navbar.php"); ?>

<div class="container">
    <h2>Student Dashboard</h2>

    <div class="cards">

        <!-- REGISTER -->
        <a href="complaint.php" class="card complaint">
            <h3>📝 Register Complaint</h3>
            <p>Submit a new hostel complaint quickly.</p>
        </a>

        <!-- STATUS -->
        <a href="status.php" class="card status">
            <h3>📊 Check Status</h3>
            <p>Track your complaint progress.</p>
        </a>

        <!-- 🔥 FIXED PROFILE -->
        <a href="student_profile.php" class="card profile">
            <h3>👤 Profile</h3>
            <p>View your account details.</p>
        </a>

    </div>
</div>

</body>
</html>