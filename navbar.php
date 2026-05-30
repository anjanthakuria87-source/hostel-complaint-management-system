<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* Navbar container */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    background: linear-gradient(90deg, #141e30, #243b55);
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

/* Logo */
.navbar .logo {
    color: #00d4ff;
    font-size: 24px;
    font-weight: bold;
    letter-spacing: 1px;
}

/* Links container */
.nav-links {
    display: flex;
    gap: 25px;
}

/* Links style */
.nav-links a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    position: relative;
    transition: 0.3s;
}

/* Hover effect */
.nav-links a::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: -5px;
    left: 0;
    background-color: #00d4ff;
    transition: 0.3s;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-links a:hover {
    color: #00d4ff;
}

/* Logout button style */
.logout {
    padding: 6px 12px;
    border: 1px solid #ff4d4d;
    border-radius: 5px;
    color: #ff4d4d !important;
}

.logout:hover {
    background: #ff4d4d;
    color: #fff !important;
}
</style>

<nav class="navbar">
    <div class="logo">HCMS</div>

<div class="nav-links">

    <a href="index.php">Home</a>

    <a href="dashboard.php">Dashboard</a>

    <a href="complaint.php">Register Complaint</a>

    <?php if(isset($_SESSION['roll_number'])) { ?>

        <a href="auth/logout.php">Logout</a>

    <?php } ?>

</div>
</nav>