<?php
session_start();

include("../configuration/db.php");

// Check admin login
if (!isset($_SESSION['admin_id'])) {

    header("Location: ../auth/admin_login.php");
    exit();
}

// Logged in admin hostel
$hostel_id = $_SESSION['hostel_id'];

/*
|--------------------------------------------------------------------------
| Fetch Complaints
|--------------------------------------------------------------------------
*/

$result = $conn->query("

    SELECT

        complaints.*,
        students.name,
        students.room_no,
        hostels.hostel_name

    FROM complaints

    JOIN students
    ON complaints.roll_number = students.roll_number

    JOIN hostels
    ON complaints.hostel_id = hostels.hostel_id

    WHERE complaints.hostel_id = '$hostel_id'

    ORDER BY complaints.complaint_id DESC

");

/*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$total = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE hostel_id='$hostel_id'
")->fetch_assoc()['c'];

$pending = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE hostel_id='$hostel_id'
    AND status='Pending'
")->fetch_assoc()['c'];

$resolved = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE hostel_id='$hostel_id'
    AND status='Resolved'
")->fetch_assoc()['c'];

$dismissed = $conn->query("
    SELECT COUNT(*) as c
    FROM complaints
    WHERE hostel_id='$hostel_id'
    AND status='Dismissed'
")->fetch_assoc()['c'];
?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard - HCMS</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        /* TOP BAR */

        .top-bar {
            background: #2c3e50;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h2 {
            margin: 0;
        }

        .logout {
            background: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-weight: bold;
        }

        .logout:hover {
            background: #c0392b;
        }

        /* STATS */

        .stats {
            width: 92%;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .stat-box {
            padding: 22px;
            border-radius: 12px;
            color: white;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stat-box h3 {
            margin: 0;
            font-size: 18px;
        }

        .stat-box p {
            margin-top: 12px;
            font-size: 28px;
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

        /* TABLE */

        .table-container {
            width: 92%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
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
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* STATUS */

        .status {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .status.pending {
            background: orange;
        }

        .status.resolved {
            background: #27ae60;
        }

        .status.dismissed {
            background: #e74c3c;
        }

        /* ACTION BUTTONS */

        .btn {
            display: inline-block;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .resolve-btn {
            background: #27ae60;
        }

        .resolve-btn:hover {
            background: #1f8a4d;
        }

        .dismiss-btn {
            background: #e74c3c;
        }

        .dismiss-btn:hover {
            background: #c0392b;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #666;
            font-size: 18px;
        }

    </style>

</head>

<body>

<!-- TOP BAR -->

<div class="top-bar">

    <h2>
        Admin Dashboard
    </h2>

    <a class="logout" href="./logout.php">
        Logout
    </a>

</div>

<!-- STATS -->

<div class="stats">

    <div class="stat-box total">
        <h3>Total Complaints</h3>
        <p><?php echo $total; ?></p>
    </div>

    <div class="stat-box pending">
        <h3>Pending</h3>
        <p><?php echo $pending; ?></p>
    </div>

    <div class="stat-box resolved">
        <h3>Resolved</h3>
        <p><?php echo $resolved; ?></p>
    </div>

    <div class="stat-box dismissed">
        <h3>Dismissed</h3>
        <p><?php echo $dismissed; ?></p>
    </div>

</div>

<!-- TABLE -->

<div class="table-container">

<?php if($result->num_rows > 0) { ?>

<table>

    <tr>

        <th>ID</th>
        <th>Student</th>
        <th>Hostel</th>
        <th>Room No</th>
        <th>Complaint Type</th>
        <th>Comments</th>
        <th>Status</th>
        <th>Actions</th>

    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td>
            <?php echo $row['complaint_id']; ?>
        </td>

        <td>
            <?php echo $row['name']; ?>
        </td>

        <td>
            <?php echo $row['hostel_name']; ?>
        </td>

        <td>
            <?php echo $row['room_no']; ?>
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

        <!-- ACTIONS -->

        <td>

            <?php if($row['status'] == "pending") { ?>

                <a class="btn resolve-btn"
                   href="../actions/update_status.php?id=<?php echo $row['complaint_id']; ?>&status=resolved">

                    Resolve

                </a>

                <a class="btn dismiss-btn"
                   href="../actions/update_status.php?id=<?php echo $row['complaint_id']; ?>&status=dismissed">

                    Dismiss

                </a>
            <?php } else { ?>

    <a class="btn"
       style="background:#f39c12;"
       href="../actions/update_status.php?id=<?php echo $row['complaint_id']; ?>&status=pending">

        Reopen

    </a>

<?php } ?>

        </td>

    </tr>

    <?php } ?>

</table>

<?php } else { ?>

    <div class="empty">
        No complaints found.
    </div>

<?php } ?>

</div>

</body>
</html>