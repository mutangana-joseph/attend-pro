<?php

ob_start();

error_reporting(0);

require "../vendor/autoload.php";
require "../config/db.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;



// Filters

$from = $_GET["from"] ?? date("Y-m-d");

$to = $_GET["to"] ?? date("Y-m-d");

$status = $_GET["status"] ?? "All";



// Fetch attendance records

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


$params = [

    $from,

    $to

];



if($status != "All"){

    $sql .= " AND attendance.status = ? ";

    $types .= "s";

    $params[] = $status;

}



$sql .= "

ORDER BY attendance.attendance_date DESC,

students.reg_number ASC

";



$stmt = $conn->prepare($sql);


$stmt->bind_param($types, ...$params);


$stmt->execute();


$result = $stmt->get_result();




// Create spreadsheet

$spreadsheet = new Spreadsheet();


$sheet = $spreadsheet->getActiveSheet();


$sheet->setTitle("Attendance Report");




// Title

$sheet->mergeCells("A1:E1");


$sheet->setCellValue(
    "A1",
    "AttendPro Attendance Report"
);



$sheet->getStyle("A1")->getFont()
      ->setBold(true)
      ->setSize(16);



$sheet->getStyle("A1")
      ->getAlignment()
      ->setHorizontal(
          Alignment::HORIZONTAL_CENTER
      );



// Information

$sheet->setCellValue("A3","From");

$sheet->setCellValue("B3",$from);


$sheet->setCellValue("C3","To");

$sheet->setCellValue("D3",$to);


$sheet->setCellValue("A4","Status");

$sheet->setCellValue("B4",$status);





// Table headers

$headers = [

    "A6" => "#",

    "B6" => "Registration Number",

    "C6" => "Student Name",

    "D6" => "Attendance Date",

    "E6" => "Status"

];



foreach($headers as $cell=>$value){

    $sheet->setCellValue($cell,$value);

}




// Header styling

$sheet->getStyle("A6:E6")->applyFromArray([

    "font"=>[

        "bold"=>true,

        "color"=>[

            "rgb"=>"FFFFFF"

        ]

    ],


    "fill"=>[

        "fillType"=>Fill::FILL_SOLID,

        "startColor"=>[

            "rgb"=>"1E40AF"

        ]

    ],


    "alignment"=>[

        "horizontal"=>Alignment::HORIZONTAL_CENTER

    ]

]);





// Insert records


$rowNumber = 7;

$count = 1;



while($row = $result->fetch_assoc()){



    $sheet->setCellValue(
        "A".$rowNumber,
        $count++
    );


    $sheet->setCellValue(
        "B".$rowNumber,
        $row["reg_number"]
    );


    $sheet->setCellValue(
        "C".$rowNumber,
        $row["first_name"]." ".$row["last_name"]
    );


    $sheet->setCellValue(
        "D".$rowNumber,
        $row["attendance_date"]
    );


    $sheet->setCellValue(
        "E".$rowNumber,
        $row["status"]
    );


    $rowNumber++;

}




// Borders

$lastRow = $rowNumber - 1;


$sheet->getStyle("A6:E".$lastRow)

      ->getBorders()

      ->getAllBorders()

      ->setBorderStyle(
          Border::BORDER_THIN
      );




// Auto size columns

foreach(range("A","E") as $column){

    $sheet->getColumnDimension($column)
          ->setAutoSize(true);

}




// Download


$fileName = "AttendPro_Attendance_Report.xlsx";


header(
    "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
);


header(
    "Content-Disposition: attachment; filename=\"$fileName\""
);


header(
    "Cache-Control: max-age=0"
);



ob_end_clean();



$writer = new Xlsx($spreadsheet);


$writer->save("php://output");


exit();

?>