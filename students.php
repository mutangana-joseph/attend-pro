<?php

echo "<link rel='stylesheet' href='css/student.css'>";

$pageTitle = "Students";
$page = "students";

require "includes/header.php";
require "includes/sidebar.php";

?>



<link rel="stylesheet" href="css/student.css">

<main class="main-content">

    <div class="page-header">

        <div>
            <h1>Student Registration</h1>
            <p>Register students before recording attendance.</p>
        </div>

        <a href="attendance.php" class="btn">
            <i class="fa-solid fa-calendar-check"></i>
            Take Attendance
        </a>

    </div>

    <section class="card">

        <div class="section-title">

            <h2>
                <i class="fa-solid fa-user-plus"></i>
                Add New Student
            </h2>

        </div>

        <form action="students.php" method="POST" class="student-form">

            <div class="form-group">

                <label>Registration Number</label>

                <input
                type="text"
                name="reg_number"
                placeholder="e.g. AUCA/24/001"
                required>

            </div>

            <div class="form-group">

                <label>First Name</label>

                <input
                type="text"
                name="first_name"
                placeholder="Enter first name"
                required>

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <input
                type="text"
                name="last_name"
                placeholder="Enter last name"
                required>

            </div>

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>

                </select>

            </div>

           

            <div class="form-group">

                <label>Phone Number</label>

                <input
                type="text"
                name="phone"
                placeholder="07XXXXXXXX">

            </div>

            

            <div class="form-group full-width">

                <button class="btn" type="submit">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Student

                </button>

            </div>

        </form>

    </section>


    <section class="card student-list">

        <div class="section-title">

            <h2>

                <i class="fa-solid fa-users"></i>

                Registered Students

            </h2>

        </div>

        <table>

            <thead>

                <tr>

                    <th>#</th>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Programme</th>
                    <th>Phone</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <!-- PHP Loop Here -->

                <tr>

                    <td>1</td>

                    <td>AUCA/24/001</td>

                    <td>John Doe</td>

                    <td>Male</td>

                    <td>BIT</td>

                    <td>0780000000</td>

                    <td class="actions">

                        <a href="#" class="edit">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </a>

                        <a href="#" class="delete">

                            <i class="fa-solid fa-trash"></i>

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