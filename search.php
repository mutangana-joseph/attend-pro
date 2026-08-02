<?php

require "includes/session.php";

$pageTitle = "Search Attendance";
$page = "search";

require "includes/header.php";
require "includes/sidebar.php";
require "config/db.php";

$reg_number = "";
$name = "";
$date = "";

$sql = "
SELECT
    attendance.id,
    students.reg_number,
    students.first_name,
    students.last_name,
    attendance.status,
    attendance.attendance_date
FROM attendance
JOIN students
ON attendance.student_id = students.id
WHERE 1=1
";

$params = [];
$types = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $reg_number = trim($_GET["reg_number"] ?? "");
    $name = trim($_GET["name"] ?? "");
    $date = trim($_GET["attendance_date"] ?? "");

    if (!empty($reg_number)) {

        $sql .= " AND students.reg_number LIKE ?";

        $params[] = "%{$reg_number}%";
        $types .= "s";
    }

    if (!empty($name)) {

        $sql .= " AND (students.first_name LIKE ? OR students.last_name LIKE ?)";

        $params[] = "%{$name}%";
        $params[] = "%{$name}%";
        $types .= "ss";
    }

    if (!empty($date)) {

        $sql .= " AND attendance.attendance_date = ?";

        $params[] = $date;
        $types .= "s";
    }

}

$sql .= " ORDER BY attendance.attendance_date DESC, students.reg_number";

$stmt = $conn->prepare($sql);

if (!empty($params)) {

    $stmt->bind_param($types, ...$params);

}

$stmt->execute();

$result = $stmt->get_result();

$count = 1;

?>

<link rel="stylesheet" href="css/search.css">

<main class="main-content">

<div class="page-header">

    <div>

        <h1>Search Attendance</h1>

        <p>Find student attendance records quickly.</p>

    </div>

</div>

<section class="card search-box">

<h2>

<i class="fa-solid fa-magnifying-glass"></i>

Search Records

</h2>

<form method="GET">

<div class="search-grid">

<div class="form-group">

<label>Registration Number</label>

<input
type="text"
name="reg_number"
value="<?= htmlspecialchars($reg_number) ?>"
placeholder="AUCA/24/001">

</div>

<div class="form-group">

<label>Student Name</label>

<input
type="text"
name="name"
value="<?= htmlspecialchars($name) ?>"
placeholder="Enter student name">

</div>

<div class="form-group">

<label>Attendance Date</label>

<input
type="date"
name="attendance_date"
value="<?= htmlspecialchars($date) ?>">

</div>

</div>

<button class="btn">

<i class="fa-solid fa-search"></i>

Search Attendance

</button>

</form>

</section>

<section class="card results">

<div class="section-title">

<h2>

<i class="fa-solid fa-list"></i>

Search Results

</h2>

</div>

<table>

<thead>

<tr>

<th>#</th>
<th>Reg Number</th>
<th>Name</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php if($result->num_rows > 0): ?>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td><?= $count++ ?></td>

<td><?= htmlspecialchars($row["reg_number"]) ?></td>

<td>

<?= htmlspecialchars($row["first_name"]) ?>

<?= htmlspecialchars($row["last_name"]) ?>

</td>

<td>

<?= htmlspecialchars($row["attendance_date"]) ?>

</td>

<td>

<span class="status <?= strtolower($row["status"]) ?>">

<?= htmlspecialchars($row["status"]) ?>

</span>

</td>

<td>

<a
href="update.php?id=<?= $row["id"] ?>"
class="edit-btn">

<i class="fa-solid fa-pen"></i>

</a>

</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>

<td colspan="6" style="text-align:center;">

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