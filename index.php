<?php include("components/navbar.php"); ?>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f4f7fb;
}

/* Hero Section */
.hero {
    height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: linear-gradient(rgba(20,30,48,0.8), rgba(36,59,85,0.9)),
                url('https://images.unsplash.com/photo-1551887373-2f9c6c2f6c37');
    background-size: cover;
    color: white;
    text-align: center;
    padding: 20px;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 10px;
}

.hero p {
    font-size: 18px;
    margin-bottom: 20px;
}

/* Buttons */
.btn {
    padding: 12px 25px;
    margin: 10px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-login {
    background: #00d4ff;
    color: black;
}

.btn-login:hover {
    background: #00aacc;
}

.btn-register {
    background: transparent;
    border: 2px solid #00d4ff;
    color: white;
}

.btn-register:hover {
    background: #00d4ff;
    color: black;
}

/* Features Section */
.features {
    padding: 50px;
    text-align: center;
}

.features h2 {
    margin-bottom: 30px;
}

.feature-box {
    display: inline-block;
    width: 250px;
    margin: 15px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.feature-box:hover {
    transform: translateY(-10px);
}

.feature-box h3 {
    margin-bottom: 10px;
}

/* Info Section */
.info {
    background: #fff;
    padding: 50px;
    text-align: center;
}

.info p {
    max-width: 700px;
    margin: auto;
    line-height: 1.6;
}

/* Footer */
.footer {
    background: #141e30;
    color: white;
    text-align: center;
    padding: 15px;
}
</style>

<!-- HERO -->
<div class="hero">
    <h1>HCMS - Hostel Complaint Management System</h1>
    <p>Quickly register, track, and resolve hostel issues without hassle</p>

    <div>
        <a href="auth/login.php"><button class="btn btn-login">Login</button></a>
        <a href="auth/register.php"><button class="btn btn-register">Register</button></a>
    </div>
</div>

<!-- FEATURES -->
<div class="features">
    <h2>🚀 Key Features</h2>

    <div class="feature-box">
        <h3>📝 Easy Complaint</h3>
        <p>Submit complaints in seconds with simple online form.</p>
    </div>

    <div class="feature-box">
        <h3>📊 Live Tracking</h3>
        <p>Track complaint status: Pending, In Progress, Resolved.</p>
    </div>

    <div class="feature-box">
        <h3>⚡ Fast Resolution</h3>
        <p>Admins quickly assign and resolve issues efficiently.</p>
    </div>

    <div class="feature-box">
        <h3>📁 History</h3>
        <p>View all your previous complaints anytime.</p>
    </div>
</div>

<!-- INFO -->
<div class="info">
    <h2>Why Use HCMS?</h2>
    <p>
        Hostel Complaint Management System (HCMS) helps students easily report 
        issues related to electricity, water, internet, maintenance, and cleanliness. 
        It ensures transparency, faster response, and better communication between 
        students and hostel authorities.
    </p>
</div>

<!-- FOOTER -->
<div class="footer">
    <p>© 2026 HCMS | Designed for Hostel Management</p>
</div>