<?php

$pageTitle = "Search Attendance";
$page = "search";

require "includes/header.php";
require "includes/sidebar.php";

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


<form method="POST">


<div class="search-grid">


<div class="form-group">

<label>Registration Number</label>

<input 
type="text"
placeholder="AUCA/24/001">


</div>



<div class="form-group">

<label>Student Name</label>

<input 
type="text"
placeholder="Enter student name">


</div>



<div class="form-group">

<label>Attendance Date</label>

<input 
type="date">


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


<tr>

<td>1</td>

<td>AUCA/24/001</td>

<td>John Doe</td>

<td>01 Aug 2026</td>

<td>

<span class="status present">

Present

</span>

</td>

<td>

<a href="#" class="edit-btn">

<i class="fa-solid fa-pen"></i>

</a>


</td>


</tr>




<tr>

<td>2</td>

<td>AUCA/24/002</td>

<td>Jane Smith</td>

<td>01 Aug 2026</td>

<td>

<span class="status absent">

Absent

</span>

</td>

<td>

<a href="#" class="edit-btn">

<i class="fa-solid fa-pen"></i>

</a>


</td>


</tr>



<tr>

<td>3</td>

<td>AUCA/24/003</td>

<td>Peter Johnson</td>

<td>01 Aug 2026</td>

<td>

<span class="status late">

Late

</span>

</td>

<td>

<a href="#" class="edit-btn">

<i class="fa-solid fa-pen"></i>

</a>


</td>


</tr>



</tbody>



</table>


</section>



</main>


<?php

require "includes/footer.php";

?>