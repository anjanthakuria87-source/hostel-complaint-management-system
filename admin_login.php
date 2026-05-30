<!DOCTYPE html>
<html>
<head>

<title>Admin Login - HCMS</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #0f2027, #2c5364);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 400px;
    background: white;
    padding: 35px;
    border-radius: 15px;
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

input {
    width: 100%;
    padding: 11px;
    border: 1px solid #ccc;
    border-radius: 7px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 13px;
    background: #2c5364;
    color: white;
    border: none;
    border-radius: 7px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #203a43;
}

.link {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #2c5364;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="container">

    <h2>Admin Login</h2>

    <form action="../actions/admin_login_action.php" method="POST">

        <div class="form-group">

            <label>Email Address</label>

            <input 
                type="email"
                name="email"
                required>

        </div>

        <div class="form-group">

            <label>Password</label>

            <input 
                type="password"
                name="password"
                required>

        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <a class="link" href="admin_register.php">
        Create Admin Account
    </a>

</div>

</body>
</html>