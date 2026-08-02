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
    font-family: DejaVu Sans, Arial, sans-serif;
    color:#1f2937;
    font-size:14px;
}

.header{
    background:#1e3a8a;
    color:white;
    text-align:center;
    padding:18px;
    border-radius:6px;
    margin-bottom:20px;
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
    margin-top:20px;
}

th{
    background:#2563eb;
    color:white;
    padding:12px;
    font-size:13px;
}

td{
    padding:10px;
    border:1px solid #ddd;
}

tbody tr:nth-child(even){
    background:#f8fafc;
}
.present{
    color:#166534;
    background:#dcfce7;
    padding:4px 10px;
    border-radius:12px;
    font-weight:bold;
}

.absent{
    color:#991b1b;
    background:#fee2e2;
    padding:4px 10px;
    border-radius:12px;
    font-weight:bold;
}

.late{
    color:#92400e;
    background:#fef3c7;
    padding:4px 10px;
    border-radius:12px;
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