<?php

require "includes/session.php";

echo "<link rel='stylesheet' href='css/attendance.css'>";

$pageTitle = "Attendance";
$page = "attendance";
$cssFile = "attendance.css";

require "includes/header.php";
require "includes/sidebar.php";
require "config/db.php";

$current_date = date("Y-m-d");

$success = "";
$error = "";

/* ==========================
   SAVE ATTENDANCE
========================== */
$inserted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $attendance_date = date("Y-m-d");

    // Check if today's attendance already exists
    $check = $conn->prepare(
        "SELECT id
         FROM attendance
         WHERE student_id = ?
         AND attendance_date = ?"
    );

    // Insert attendance
    $insert = $conn->prepare(
        "INSERT INTO attendance
        (student_id, status, attendance_date)
        VALUES (?, ?, ?)"
    );

    foreach ($_POST["status"] as $student_id => $status) {

        $check->bind_param(
            "is",
            $student_id,
            $attendance_date
        );

        $check->execute();

        $result = $check->get_result();
        if ($result->num_rows > 0){
            $update = $conn->prepare(
                "UPDATE attendance
                 SET status = ?
                 WHERE student_id = ?
                 AND attendance_date = ?"
            );

            $update->bind_param(
            "sis",
            $status,
            $student_id,
            $attendance_date
            );
            
            $update->execute();
            $inserted = true;
        }
        else{

            $insert->bind_param(
                "iss",
                $student_id,
                $status,
                $attendance_date
            );

            $insert->execute();
            $inserted = true;

        }

    }
    if ($inserted) {

    $success = "Attendance recorded successfully.";
    } 
    else {

    $error = "Today's attendance has already been recorded.";

}

    

}


/* ==========================
   SEARCH STUDENT
========================== */


$search = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {

    $search = trim($_GET["search"]);

    $sql = "SELECT *
            FROM students
            WHERE reg_number LIKE ?
               OR first_name LIKE ?
               OR last_name LIKE ?";

    $stmt = $conn->prepare($sql);

    $keyword = "%$search%";

    $stmt->bind_param("sss", $keyword, $keyword, $keyword);

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $sql = "SELECT * FROM students ORDER BY reg_number";

    $result = $conn->query($sql);

}


$count = 1;

?>



<main class="main-content">

    <div class="page-header">

        <div>

            <h1>Take Attendance</h1>

            <p>Record today's attendance for registered students.</p>

        </div>

        

    </div>


    <section class="card attendance-top">

        <div class="attendance-info">

            <div>

                <label>Attendance Date</label>

                <input type="date" value="<?=htmlspecialchars($current_date)?>" readonly>

            </div>

            <div>
            <form method="GET">
            <label>Search Student</label>
            <div class="search">
                <input
                    type="text"
                    name="search"
                    value="<?= htmlspecialchars($search)?>"
                    placeholder="Registration number or name">

                <button type="submit" class="btn">
                    Search
                </button>
                </div>
                 </form>

                

               

            </div>

        </div>

    </section>
    <?php require "includes/alert.php";?>

    <form action="" method="POST">

        <section class="card attendance-table">

            <table>

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Registration No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Late</th>

                    </tr>

                </thead>

                <tbody>

                <?php while ($student = $result->fetch_assoc()): ?>


                    <tr>

                    <td><?= $count++ ?></td>
                    <td><?=htmlspecialchars($student["reg_number"]) ?></td>
                    <td><?=htmlspecialchars($student["first_name"]) ?></td>
                    <td><?=htmlspecialchars($student["last_name"]) ?></td>

                    <td class="radio-cell">
                    <input
                        type="radio"
                        name="status[<?= $student['id'] ?>]"
                        value="Present"
                        checked
                        >
                    </td>

                    <td class="radio-cell">
                        <input
                            type="radio"
                            name="status[<?= $student['id'] ?>]"
                            value="Absent">
                    </td>

                    <td class="radio-cell">
                        <input
                            type="radio"
                            name="status[<?= $student['id'] ?>]"
                            value="Late">
                    </td>

                    </tr>
                    <?php endwhile; ?>

                </tbody>

            </table>

            <div class="save-section">

                <button class="btn">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Attendance

                </button>

            </div>

        </section>

    </form>

</main>

<?php

require "includes/footer.php";

?>