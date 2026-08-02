<?php

require "../config/db.php";

$from = $_GET["from"] ?? date("Y-m-d");
$to = $_GET["to"] ?? date("Y-m-d");
$status = $_GET["status"] ?? "All";

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

$types = "ss";
$params = [$from, $to];

if ($status != "All") {

    $sql .= " AND attendance.status = ?";

    $types .= "s";

    $params[] = $status;
}

$sql .= " ORDER BY attendance.attendance_date DESC,
students.reg_number";

$stmt = $conn->prepare($sql);

$stmt->bind_param($types, ...$params);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Attendance Report</title>

<link rel="stylesheet" href="../css/style.css">

<style>

body{

font-family:Arial,sans-serif;

padding:40px;

}

h1{

text-align:center;

margin-bottom:10px;

}

.report-info{

margin-bottom:30px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

border:1px solid #ccc;

padding:10px;

text-align:left;

}

th{

background:#1e40af;

color:white;

}

.present{

color:green;

font-weight:bold;

}

.absent{

color:red;

font-weight:bold;

}

.late{

color:orange;

font-weight:bold;

}

</style>

</head>

<body>

<h1>AttendPro Attendance Report</h1>

<div class="report-info">

<p>

<strong>From:</strong>

<?= htmlspecialchars($from) ?>

</p>

<p>

<strong>To:</strong>

<?= htmlspecialchars($to) ?>

</p>

<p>

<strong>Status:</strong>

<?= htmlspecialchars($status) ?>

</p>

</div>

<table>

<thead>

<tr>

<th>#</th>

<th>Registration</th>

<th>Student</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$count=1;

while($row=$result->fetch_assoc()):

?>

<tr>

<td><?= $count++ ?></td>

<td><?= htmlspecialchars($row["reg_number"]) ?></td>

<td>

<?= htmlspecialchars($row["first_name"]) ?>

<?= htmlspecialchars($row["last_name"]) ?>

</td>

<td><?= htmlspecialchars($row["attendance_date"]) ?></td>

<td class="<?= strtolower($row["status"]) ?>">

<?= htmlspecialchars($row["status"]) ?>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

<script>

window.onload=function(){

window.print();

}

</script>

</body>

</html>