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
    <title>Register Complaint - HCMS</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            max-width: 550px;
            margin: 50px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2c3e50;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1a252f;
        }

    </style>
</head>

<body>

<?php include("components/navbar.php"); ?>

<div class="container">

    <h2>Register Complaint</h2>

    <form action="actions/complaint_action.php" method="POST">

        <!-- Complaint Type -->
        <div class="form-group">

            <label>Complaint Type</label>

            <select name="complaint_type" required>

                <option value="">-- Select Complaint Type --</option>

                <option value="Electricity">Electricity</option>
                <option value="Water">Water</option>
                <option value="Internet">Internet</option>
                <option value="Cleaning">Cleaning</option>
                <option value="Food">Food</option>
                <option value="Furniture">Furniture</option>
                <option value="Washroom">Washroom</option>
                <option value="Room Damage">Room Damage</option>
                <option value="Security">Security</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Noise">Noise</option>
                <option value="Other">Other</option>

            </select>

        </div>

        <!-- Comments -->
        <div class="form-group">

            <label>Comments / Description</label>

            <textarea 
                name="comments"
                placeholder="Describe your issue clearly..."
                required></textarea>

        </div>

        <button type="submit">
            Submit Complaint
        </button>

    </form>

</div>

</body>
</html>