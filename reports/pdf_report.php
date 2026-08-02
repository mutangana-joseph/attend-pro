<?php

require "../vendor/autoload.php";
require "../config/db.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$from = $_GET["from"] ?? date("Y-m-d");
$to = $_GET["to"] ?? date("Y-m-d");
$status = $_GET["status"] ?? "All";

/* ==========================
   FETCH REPORT
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
";

$stmt = $conn->prepare($sql);

$stmt->bind_param($types, ...$params);

$stmt->execute();

$result = $stmt->get_result();

/* ==========================
   BUILD HTML
========================== */

$html = '

<h2 style="text-align:center;">
AttendPro Attendance Report
</h2>

<p><strong>From:</strong> '.$from.'</p>

<p><strong>To:</strong> '.$to.'</p>

<p><strong>Status:</strong> '.$status.'</p>

<table
border="1"
cellspacing="0"
cellpadding="8"
width="100%">

<tr>

<th>#</th>
<th>Reg Number</th>
<th>Student</th>
<th>Date</th>
<th>Status</th>

</tr>

';

$count = 1;

while($row = $result->fetch_assoc()){

$html .= '

<tr>

<td>'.$count++.'</td>

<td>'.$row["reg_number"].'</td>

<td>'.$row["first_name"].' '.$row["last_name"].'</td>

<td>'.$row["attendance_date"].'</td>

<td>'.$row["status"].'</td>

</tr>

';

}

$html .= "</table>";

/* ==========================
   GENERATE PDF
========================== */

$options = new Options();

$options->set("isRemoteEnabled", true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper("A4","portrait");

$dompdf->render();

$dompdf->stream(

"Attendance_Report.pdf",

["Attachment"=>true]

);

exit();