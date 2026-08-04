<?php

require "includes/session.php";

echo "<link rel='stylesheet' href='css/dashboard.css'>";


$pageTitle = "Dashboard";
$page = "dashboard";
require "includes/header.php";
require "includes/sidebar.php";
require "config/db.php";


$is_recorded = false;


$current_date = date("y-m-d");


$sql = "select attendance_date from attendance where attendance_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $is_recorded = true;
    
}

$sql = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d %h:%i %p') AS recorded_datetime
        FROM attendance
        ORDER BY attendance_date DESC
        LIMIT 1";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$last_attendance = $row['recorded_datetime'];



?>

<main class="main-content">

    <header class="page-header">

        <div>

            <h1>Dashboard</h1>

            <p>Welcome back! Manage your student attendance efficiently.</p>

        </div>

        <div class="teacher-profile">

            <i class="fa-solid fa-circle-user"></i>

            <span><?= htmlspecialchars($first_name)?></span>

        </div>

    </header>


    <!-- Statistics -->
     <?php require "includes/statistics.php";?>
    <section class="stats">

        <div class="card stat-card">

            <div>

                <h3>Total Students</h3>

                <h2><?= $total ?></h2>

            </div>

            <i class="fa-solid fa-user-graduate"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Present Today</h3>

                <h2><?= $present ?></h2>

            </div>

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Absent Today</h3>

                <h2><?= $absent ?></h2>

            </div>

            <i class="fa-solid fa-circle-xmark"></i>

        </div>

        <div class="card stat-card">

            <div>

                <h3>Late Today</h3>

                <h2><?= $late ?></h2>

            </div>

            <i class="fa-solid fa-clock"></i>

        </div>

    </section>


    <!-- Attendance Status -->

    <?php if($is_recorded): ?>
    <section class="card attendance-status">

        <h2>Today's Attendance</h2>

        <p>

            Today's attendance has been recorded .

        </p>

        <a href="attendance.php" class="btn">

            <i class="fa-solid fa-calendar-check"></i>

            Update Attendance

        </a>

    </section>
    

    <?php endif; ?>
    <?php if(!$is_recorded): ?>
    <section class="card attendance-status">

        <h2>Today's Attendance</h2>

        <p>

            Today's attendance has not been recorded .

        </p>

        <a href="attendance.php" class="btn">

            <i class="fa-solid fa-calendar-check"></i>

            Take Attendance

        </a>

    </section>
    <!-- Recent Activity -->
  
    <?php endif; ?>
    <section class="card recent-activity">

        <h2>

            <i class="fa-solid fa-clock-rotate-left"></i>

            Recent Activity

        </h2>

        <ul>

            <li>

                <?= $last_attendance?> Attendance recorded 

            </li>

        </ul>

    </section>

    

</main>

<?php

require "includes/footer.php";

?>