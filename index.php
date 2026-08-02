<?php
// index.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttendPro | Smart Attendance System</title>

    <link rel="stylesheet" href="css/home.css">
</head>

<body>

<header class="navbar">
    <div class="logo">
        AttendPro
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Register</a>
    </nav>
</header>


<section class="hero">

    <div class="hero-content">

        <h1>
            Welcome to AttendPro
        </h1>

        <p>
            A simple and efficient attendance management system
            designed to help students and lecturers manage attendance
            records easily.
        </p>

        <div class="buttons">

            <a href="login.php" class="btn primary">
                Login
            </a>

            <a href="signup.php" class="btn secondary">
                Create Account
            </a>

        </div>

    </div>

</section>


<section class="features">

    <h2>Why AttendPro?</h2>

    <div class="cards">

        <div class="card">
            <h3>Easy Attendance</h3>
            <p>
                Lecturers can record attendance quickly
                and students can track their records.
            </p>
        </div>


        <div class="card">
            <h3>Secure Records</h3>
            <p>
                Attendance data is stored safely in a
                centralized database.
            </p>
        </div>


        <div class="card">
            <h3>Simple Management</h3>
            <p>
                Manage students, classes, and attendance
                information in one place.
            </p>
        </div>

    </div>

</section>


<footer>

    <p>
        © <?php echo date("Y"); ?> AttendPro. All rights reserved.
    </p>

</footer>


</body>
</html>