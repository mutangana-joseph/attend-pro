<?php

$pageTitle = "Sign Up";

require "includes/header.php";

?>

<link rel="stylesheet" href="css/auth.css">

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">

            <i class="fa-solid fa-user-plus"></i>

            <h1>Create Lecturer Account</h1>

            <p>AttendPro Student Attendance System</p>

        </div>

        <form action="signup.php" method="POST">

            <div class="form-group">

                <label>Full Name</label>

                <input
                type="text"
                name="fullname"
                placeholder="Enter full name"
                required>

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input
                type="email"
                name="email"
                placeholder="Enter email"
                required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                type="password"
                name="password"
                placeholder="Create password"
                required>

            </div>

            <div class="form-group">

                <label>Confirm Password</label>

                <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                required>

            </div>

            <button type="submit" class="btn auth-btn">

                <i class="fa-solid fa-user-check"></i>

                Create Account

            </button>

        </form>

        <div class="auth-footer">

            Already have an account?

            <a href="login.php">Login</a>

        </div>

    </div>

</div>

<?php

require "includes/footer.php";

?>