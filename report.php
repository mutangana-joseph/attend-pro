<?php
echo "<link rel='stylesheet' href='css/report.css'>";
$pageTitle = "Reports";
$page = "report";

require "includes/header.php";
require "includes/sidebar.php";

?>

<link rel="stylesheet" href="css/report.css">


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




<div class="filter-grid">


<div class="form-group">

<label>From Date</label>

<input type="date">


</div>



<div class="form-group">

<label>To Date</label>

<input type="date">


</div>



<div class="form-group">

<label>Status</label>


<select>

<option>All</option>

<option>Present</option>

<option>Absent</option>

<option>Late</option>


</select>


</div>



</div>




<div class="report-buttons">


<button class="btn">

<i class="fa-solid fa-chart-line"></i>

Generate Report

</button>


<button class="print-btn">

<i class="fa-solid fa-print"></i>

Print

</button>



<button class="pdf-btn">

<i class="fa-solid fa-file-pdf"></i>

PDF

</button>



<button class="excel-btn">

<i class="fa-solid fa-file-excel"></i>

Excel

</button>


</div>



</section>






<section class="report-cards">


<div class="report-card">

<i class="fa-solid fa-users"></i>

<div>

<h3>Total Records</h3>

<h2>250</h2>

</div>


</div>



<div class="report-card">

<i class="fa-solid fa-circle-check"></i>

<div>

<h3>Present</h3>

<h2>230</h2>

</div>


</div>




<div class="report-card">

<i class="fa-solid fa-circle-xmark"></i>

<div>

<h3>Absent</h3>

<h2>10</h2>

</div>


</div>



<div class="report-card">

<i class="fa-solid fa-clock"></i>

<div>

<h3>Late</h3>

<h2>10</h2>

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


<tr>

<td>AUCA/24/001</td>

<td>John Doe</td>

<td>01 Aug 2026</td>

<td>

<span class="status present">

Present

</span>

</td>


</tr>


<tr>

<td>AUCA/24/002</td>

<td>Jane Smith</td>

<td>01 Aug 2026</td>

<td>

<span class="status absent">

Absent

</span>

</td>


</tr>



</tbody>



</table>


</section>



</main>


<?php

require "includes/footer.php";

?>