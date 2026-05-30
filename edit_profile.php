<?php
session_start();

include("configuration/db.php");

// Check login
if (!isset($_SESSION['roll_number'])) {

    header("Location: auth/login.php");
    exit();
}

$roll_number = $_SESSION['roll_number'];

/*
|--------------------------------------------------------------------------
| Fetch Student Details + Hostel
|--------------------------------------------------------------------------
*/

$sql = "SELECT students.*, hostels.hostel_name
        FROM students
        JOIN hostels
        ON students.hostel_id = hostels.hostel_id
        WHERE students.roll_number='$roll_number'";

$user = $conn->query($sql)->fetch_assoc();

/*
|--------------------------------------------------------------------------
| Fetch Hostel List
|--------------------------------------------------------------------------
*/

$hostels = $conn->query("
    SELECT * FROM hostels
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile - HCMS</title>

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

        .box {
            background: white;
            padding: 35px;
            border-radius: 15px;
            width: 430px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #1e3c72;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            border-color: #2a5298;
            outline: none;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #1f8a4d;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2a5298;
            text-decoration: none;
            font-weight: bold;
        }

        .back:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

<div class="box">

    <h2>Edit Profile</h2>

    <form action="actions/update_profile_action.php" method="POST">

        <!-- Full Name -->

        <div class="form-group">

            <label>Full Name</label>

            <input 
                type="text"
                name="name"
                value="<?php echo $user['name']; ?>"
                required>

        </div>

        <!-- Email -->

        <div class="form-group">

            <label>Email Address</label>

            <input 
                type="email"
                name="email"
                value="<?php echo $user['email']; ?>"
                required>

        </div>

        <!-- Phone -->

        <div class="form-group">

            <label>Phone Number</label>

            <input 
                type="text"
                name="phone"
                value="<?php echo $user['phone']; ?>"
                required>

        </div>

        <!-- Room Number -->

        <div class="form-group">

            <label>Room Number</label>

            <input 
                type="text"
                name="room_no"
                value="<?php echo $user['room_no']; ?>"
                required>

        </div>

        <!-- Hostel -->

        <div class="form-group">

            <label>Select Hostel</label>

            <select name="hostel_id" required>

                <?php while($hostel = $hostels->fetch_assoc()) { ?>

                    <option 
                        value="<?php echo $hostel['hostel_id']; ?>"

                        <?php 
                        if($hostel['hostel_id'] == $user['hostel_id']) 
                        echo "selected"; 
                        ?>
                    >

                        <?php echo $hostel['hostel_name']; ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <button type="submit">
            Update Profile
        </button>

    </form>

    <a class="back" href="student_profile.php">
        ⬅ Back to Profile
    </a>

</div>

</body>
</html>