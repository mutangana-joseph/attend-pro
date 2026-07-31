<?php

echo "<link rel='stylesheet' href='css/dashboard.css'>";


$pageTitle = "Dashboard";
$page = "dashboard";
require "includes/header.php";
require "includes/sidebar.php";


?>

<main class="main-content">

    <header class="top-header">

        <div>

            <h1>Dashboard</h1>

            <p>Welcome back! Manage your student attendance efficiently.</p>

        </div>

        <div class="teacher-profile">

            <i class="fa-solid fa-circle-user"></i>

            <span>Mr. Joe</span>

        </div>

    </header>


    <!-- Statistics -->

    <section class="stats">

        <div class="card stat-card">

            <div>

                <h3>Total Students</h3>

                <h2>245</h2>

            </div>

            <i class="fa-solid fa-user-graduate"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Present Today</h3>

                <h2>230</h2>

            </div>

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Absent Today</h3>

                <h2>10</h2>

            </div>

            <i class="fa-solid fa-circle-xmark"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Late Today</h3>

                <h2>5</h2>

            </div>

            <i class="fa-solid fa-clock"></i>

        </div>

    </section>


    <!-- Attendance Status -->

    <section class="card attendance-status">

        <h2>Today's Attendance</h2>

        <p>

            Today's attendance has not been recorded yet.

        </p>

        <a href="attendance.php" class="btn">

            <i class="fa-solid fa-calendar-check"></i>

            Take Attendance

        </a>

    </section>


    <!-- Recent Activity -->

    <section class="card recent-activity">

        <h2>

            <i class="fa-solid fa-clock-rotate-left"></i>

            Recent Activity

        </h2>

        <ul>

            <li>

                No attendance has been recorded today.

            </li>

        </ul>

    </section>

</main>

<?php

require "includes/footer.php";

?>