<!DOCTYPE html>
<html>
<head>
    <title>HCMS Student Register</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        .register-box {
            background: white;
            padding: 35px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .register-box input,
        .register-box select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .register-box input:focus,
        .register-box select:focus {
            border-color: #2c5364;
            outline: none;
        }

        .register-box button {
            width: 100%;
            padding: 12px;
            background: #2c5364;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .register-box button:hover {
            background: #203a43;
        }

        .register-box a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2c5364;
            text-decoration: none;
        }

        .register-box a:hover {
            text-decoration: underline;
        }

        .title {
            position: absolute;
            top: 25px;
            left: 30px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .password-box {
            position: relative;
        }

        .password-box input {
            padding-right: 40px;
        }

        .eye {
            position: absolute;
            right: 12px;
            top: 38px;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>

<body>

<div class="title">HCMS</div>

<div class="register-box">

    <h2>Student Registration</h2>

    <?php
        include("../configuration/db.php");

        $query = "SELECT hostel_id, hostel_name FROM hostels";
        $result = mysqli_query($conn, $query);
    ?>

    <form action="../actions/register_action.php" method="POST">

        <div class="form-group">
            <label>Roll Number</label>
            <input type="text" name="roll_number" required>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
            <label>Room Number</label>
            <input type="text" name="room_no" required>
        </div>

        <div class="form-group">
            <label>Select Hostel</label>

            <select name="hostel_id" required>
                <option value="">-- Select Hostel --</option>

                <?php
                    while($row = mysqli_fetch_assoc($result)) {
                ?>

                    <option value="<?php echo $row['hostel_id']; ?>">
                        <?php echo $row['hostel_name']; ?>
                    </option>

                <?php
                    }
                ?>
            </select>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label>Password</label>

            <div class="password-box">
                <input type="password" id="password" name="password" required>
                <span class="eye" onclick="togglePassword()">👁️</span>
            </div>
        </div>

        <button type="submit">Register</button>

    </form>

    <a href="login.php">Already have an account? Login</a>

</div>

<script>
function togglePassword() {

    var pass = document.getElementById("password");

    if(pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</body>
</html>