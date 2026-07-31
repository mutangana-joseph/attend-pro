<?php

echo "<link rel='stylesheet' href='css/attendance.css'>";

$pageTitle = "Attendance";
$page = "attendance";

require "includes/header.php";
require "includes/sidebar.php";

?>

<link rel="stylesheet" href="css/attendance.css">

<main class="main-content">

    <div class="page-header">

        <div>

            <h1>Take Attendance</h1>

            <p>Record today's attendance for registered students.</p>

        </div>

        <button class="btn">

            <i class="fa-solid fa-floppy-disk"></i>

            Save Attendance

        </button>

    </div>


    <section class="card attendance-top">

        <div class="attendance-info">

            <div>

                <label>Attendance Date</label>

                <input type="date" value="2026-08-01">

            </div>

            <div>

                <label>Search Student</label>

                <input type="text" placeholder="Registration number or name">

            </div>

        </div>

    </section>


    <form action="" method="POST">

        <section class="card attendance-table">

            <table>

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Registration No</th>
                        <th>Student Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Late</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>

                        <td>AUCA/24/001</td>

                        <td>John Doe</td>

                        <td class="radio-cell">

                            <input type="radio" name="status1" checked>

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status1">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status1">

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>

                        <td>AUCA/24/002</td>

                        <td>Jane Smith</td>

                        <td class="radio-cell">

                            <input type="radio" name="status2">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status2" checked>

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status2">

                        </td>

                    </tr>

                    <tr>

                        <td>3</td>

                        <td>AUCA/24/003</td>

                        <td>Peter Johnson</td>

                        <td class="radio-cell">

                            <input type="radio" name="status3">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status3">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status3" checked>

                        </td>

                    </tr>

                    <tr>

                        <td>4</td>

                        <td>AUCA/24/004</td>

                        <td>Sarah Wilson</td>

                        <td class="radio-cell">

                            <input type="radio" name="status4" checked>

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status4">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status4">

                        </td>

                    </tr>

                    <tr>

                        <td>5</td>

                        <td>AUCA/24/005</td>

                        <td>David Brown</td>

                        <td class="radio-cell">

                            <input type="radio" name="status5">

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status5" checked>

                        </td>

                        <td class="radio-cell">

                            <input type="radio" name="status5">

                        </td>

                    </tr>

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