<div class="show_sidebar" id="show_sidebar">
    <i class="fas fa-bars"></i>
</div>
<div class="sidebar" id="sidebar">

    <div class="logo">

        <i class="fa-solid fa-graduation-cap"></i>

        <h2>AttendPro</h2>

    </div>

    <nav>

        <ul>

            <li>
                <a href="dashboard.php" class="<?= ($page=="dashboard") ? "active" : ""; ?>">

                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="students.php" class="<?= ($page=="students") ? "active" : ""; ?>">

                    <i class="fa-solid fa-user-graduate"></i>
                    Students
                </a>
            </li>

            <li>
                <a href="attendance.php" class="<?= ($page=="attendance") ? "active" : ""; ?>">
                    <i class="fa-solid fa-calendar-check"></i>
                    Attendance
                </a>
            </li>

            <li>
                <a href="search.php" class="<?= ($page=="search") ? "active" : ""; ?>">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search
                </a>
            </li>

            <li>
                <a href="report.php"  class="<?= ($page=="report") ? "active" : ""; ?>">
                    <i class="fa-solid fa-chart-column"></i>
                    Reports
                </a>
            </li>

            <li>
                <a href="logout.php" class="<?= ($page=="logout") ? "active" : ""; ?>">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </nav>

</div>

<script src="js/script.js"></script>