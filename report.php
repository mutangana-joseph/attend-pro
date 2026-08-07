<?php

require "includes/session.php";
require "config/db.php";



$pageTitle = "Reports";
$page = "report";
$cssFile = "report.css";

require "includes/header.php";
require "includes/sidebar.php";
require "includes/statistics.php";

/* ==========================
   DEFAULT FILTERS
========================== */

$from = date("Y-m-d");
$to = date("Y-m-d");
$status = "All";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!empty($_GET["from"])) {
        $from = $_GET["from"];
    }

    if (!empty($_GET["to"])) {
        $to = $_GET["to"];
    }

    if (!empty($_GET["status"])) {
        $status = $_GET["status"];
    }

}


/* ==========================
   REPORT PREVIEW
========================== */

$sql = "
SELECT
    students.reg_number,
    students.first_name,
    students.last_name,
    attendance.status,
    attendance.attendance_date
FROM attendance
JOIN students
ON attendance.student_id = students.id
WHERE attendance.attendance_date BETWEEN ? AND ?
";

$params = [$from, $to];
$types = "ss";

if ($status != "All") {

    $sql .= " AND attendance.status = ?";

    $params[] = $status;
    $types .= "s";

}

$sql .= "
ORDER BY attendance.attendance_date DESC,
students.reg_number
LIMIT 3
";

$stmt = $conn->prepare($sql);

$stmt->bind_param($types, ...$params);

$stmt->execute();

$preview = $stmt->get_result();
?>


<main class="main-content">


<div class="page-header">


<div>

<h1>Attendance Reports</h1>

<p>Generate and print attendance reports.</p>

</div>


</div>




<section class="card report-filter">


<h2>

<i class="fa-solid fa-filter"></i>

Generate Report

</h2>




<form method="GET">

<div class="filter-grid">

<div class="form-group">

<label>From Date</label>

<input
type="date"
name="from"
value="<?= htmlspecialchars($from) ?>">

</div>

<div class="form-group">

<label>To Date</label>

<input
type="date"
name="to"
value="<?= htmlspecialchars($to) ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option value="All" <?= $status=="All"?"selected":"" ?>>All</option>

<option value="Present" <?= $status=="Present"?"selected":"" ?>>Present</option>

<option value="Absent" <?= $status=="Absent"?"selected":"" ?>>Absent</option>

<option value="Late" <?= $status=="Late"?"selected":"" ?>>Late</option>

</select>

</div>

</div>
</from>




<div class="report-buttons">


<button class="btn">

<i class="fa-solid fa-chart-line"></i>

Generate Report

</button>


<button class="print-btn">
<a

href="reports/print_report.php?from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&status=<?= urlencode($status) ?>"

target="_blank"

class="print-btn">

<i class="fa-solid fa-print"></i>

Print

</a>

</button>



<button class="pdf-btn">

<a

href="reports/pdf_report.php?from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&status=<?= urlencode($status) ?>"

class="pdf-btn">

<i class="fa-solid fa-file-pdf"></i>

PDF

</a>

</button>



<button class="excel-btn">

<a href="reports/excel_report.php?from=<?= $from ?>&to=<?= $to ?>&status=<?= $status ?>">
<i class="fa-solid fa-file-excel"></i>
Export Excel
</a>

</button>


</div>



</section>






<section class="report-cards">


<div class="report-card">

<i class="fa-solid fa-users"></i>

<div>

<h3>Total Records</h3>

<h2><?= $total ?></h2>

</div>


</div>



<div class="report-card">

<i class="fa-solid fa-circle-check"></i>

<div>

<h3>Present</h3>

<h2><?= $present ?></h2>

</div>


</div>




<div class="report-card">

<i class="fa-solid fa-circle-xmark"></i>

<div>

<h3>Absent</h3>

<h2><?= $absent ?></h2>

</div>


</div>



<div class="report-card">

<i class="fa-solid fa-clock"></i>

<div>

<h3>Late</h3>

<h2><?= $late ?></h2>

</div>


</div>



</section>





<section class="card">


<h2>

<i class="fa-solid fa-file-lines"></i>

Report Preview

</h2>



<table>


<thead>

<tr>

<th>Reg No</th>

<th>Name</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>



<tbody>

<?php if($preview->num_rows > 0): ?>

    <?php while($row = $preview->fetch_assoc()): ?>

    <tr>

        <td><?= htmlspecialchars($row["reg_number"]) ?></td>

        <td>

            <?= htmlspecialchars($row["first_name"]) ?>

            <?= htmlspecialchars($row["last_name"]) ?>

        </td>

        <td><?= htmlspecialchars($row["attendance_date"]) ?></td>

        <td>

            <span class="status <?= strtolower($row["status"]) ?>">

                <?= htmlspecialchars($row["status"]) ?>

            </span>

        </td>

    </tr>

    <?php endwhile; ?>

<?php else: ?>

<tr>

    <td colspan="4" style="text-align:center;">

        No attendance records found.

    </td>

</tr>

<?php endif; ?>

</tbody>



</table>


</section>



</main>


<?php

require "includes/footer.php";

?>