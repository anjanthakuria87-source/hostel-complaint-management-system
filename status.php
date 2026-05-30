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

// Fetch complaints
$sql = "SELECT * FROM complaints
        WHERE roll_number='$roll_number'
        ORDER BY complaint_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Complaint Status - HCMS</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .page-title {
            text-align: center;
            margin: 35px 0 25px;
            color: #2c3e50;
            font-size: 30px;
        }

        .table-container {
            width: 95%;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2c3e50;
            color: white;
            padding: 14px;
            text-align: center;
        }

        td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* STATUS BADGES */

        .status {
            padding: 7px 14px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
            font-weight: bold;
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

        /* PROGRESS BAR */

        .progress-wrapper {
            width: 180px;
            margin: auto;
        }

        .progress-bar {
            display: flex;
            gap: 5px;
            margin-bottom: 5px;
        }

        .step {
            flex: 1;
            height: 8px;
            background: #dcdcdc;
            border-radius: 10px;
        }

        .active {
            background: #27ae60;
        }

        .active-dismissed {
            background: #e74c3c;
        }

        .progress-text {
            font-size: 11px;
            color: #555;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
            font-size: 18px;
        }

    </style>
</head>

<body>

<?php include("components/navbar.php"); ?>

<h2 class="page-title">My Complaint Status</h2>

<div class="table-container">

<?php if($result->num_rows > 0) { ?>

<table>

    <tr>
        <th>Complaint ID</th>
        <th>Complaint Type</th>
        <th>Comments</th>
        <th>Status</th>
        <th>Progress</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td>
            <?php echo $row['complaint_id']; ?>
        </td>

        <td>
            <?php echo $row['complaint_type']; ?>
        </td>

        <td>
            <?php echo $row['comments']; ?>
        </td>

        <!-- STATUS -->

        <td>

            <?php if($row['status'] == "pending") { ?>

                <span class="status pending">
                    Pending
                </span>

            <?php } elseif($row['status'] == "resolved") { ?>

                <span class="status resolved">
                    Resolved
                </span>

            <?php } else { ?>

                <span class="status dismissed">
                    Dismissed
                </span>

            <?php } ?>

        </td>

        <!-- PROGRESS -->

        <td>

            <div class="progress-wrapper">

                <div class="progress-bar">

                    <!-- Pending -->
                    <div class="step active"></div>

                    <!-- Resolved -->
                    <div class="step 
                    <?php 
                    if($row['status'] == 'resolved') 
                    echo 'active'; ?>">
                    </div>

                    <!-- Dismissed -->
                    <div class="step 
                    <?php 
                    if($row['status'] == 'dismissed') 
                    echo 'active-dismissed'; ?>">
                    </div>

                </div>

                <div class="progress-text">
                    Pending → Resolved / Dismissed
                </div>

            </div>

        </td>

    </tr>

    <?php } ?>

</table>

<?php } else { ?>

    <div class="empty">
        No complaints submitted yet.
    </div>

<?php } ?>

</div>

</body>
</html>