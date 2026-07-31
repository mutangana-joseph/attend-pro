<?php

$pageTitle = "Login";

require "includes/header.php";

?>

<link rel="stylesheet" href="css/auth.css">

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">

            <i class="fa-solid fa-graduation-cap"></i>

            <h1>AttendPro</h1>

            <p>Student Attendance Management System</p>

        </div>

        <form action="login.php" method="POST">

            <div class="form-group">

                <label>Email Address</label>

                <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required>

            </div>

            <button type="submit" class="btn auth-btn">

                <i class="fa-solid fa-right-to-bracket"></i>

                Login

            </button>

        </form>

        <div class="auth-footer">

            Don't have an account?

            <a href="signup.php">Create Account</a>

        </div>

    </div>

</div>

<?php

require "includes/footer.php";

?>