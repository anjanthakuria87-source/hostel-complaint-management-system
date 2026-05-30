<!DOCTYPE html>
<html>
<head>
    <title>HCMS Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 35px;
            border-radius: 12px;
            width: 380px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .login-box input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .login-box input:focus {
            border-color: #2a5298;
            outline: none;
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

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .login-box button:hover {
            background: #1e3c72;
        }

        .login-box a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2a5298;
            text-decoration: none;
        }

        .login-box a:hover {
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
    </style>
</head>

<body>

<div class="title">HCMS</div>

<div class="login-box">

    <h2>Student Login</h2>

    <form action="../actions/login_action.php" method="POST">

        <div class="form-group">
            <label>Roll Number</label>
            <input type="text" name="roll_no" required>
        </div>

        <div class="form-group">
            <label>Password</label>

            <div class="password-box">
                <input type="password" id="password" name="password" required>
                <span class="eye" onclick="togglePassword()">👁️</span>
            </div>
        </div>

        <button type="submit">Login</button>

    </form>

    <a href="register.php">Create Account</a>

</div>

<script>
function togglePassword() {

    var pass = document.getElementById("password");

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

</body>
</html>