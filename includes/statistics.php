<?php



$from = date("Y-m-d");
$to = date("Y-m-d");



/* ==========================
   TOTAL RECORDS
========================== */

$sql = "
SELECT COUNT(*) AS total
FROM attendance
WHERE attendance_date
BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$total = $stmt->get_result()->fetch_assoc()["total"];

/* ==========================
   PRESENT
========================== */

$sql = "
SELECT COUNT(*) AS present
FROM attendance
WHERE status='Present'
AND attendance_date
BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$present = $stmt->get_result()->fetch_assoc()["present"];

/* ==========================
   ABSENT
========================== */

$sql = "
SELECT COUNT(*) AS absent
FROM attendance
WHERE status='Absent'
AND attendance_date
BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$absent = $stmt->get_result()->fetch_assoc()["absent"];

/* ==========================
   LATE
========================== */

$sql = "
SELECT COUNT(*) AS late
FROM attendance
WHERE status='Late'
AND attendance_date
BETWEEN ? AND ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$late = $stmt->get_result()->fetch_assoc()["late"];

?>