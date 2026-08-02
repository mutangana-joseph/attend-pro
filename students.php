<?php
require "includes/session.php";
echo "<link rel='stylesheet' href='css/student.css'>";

$pageTitle = "Students";
$page = "students";

require "includes/header.php";
require "includes/sidebar.php";
require "config/db.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reg_number = trim($_POST["reg_number"]);
    $first_name = trim($_POST["first_name"]);
    $last_name  = trim($_POST["last_name"]);
    $gender     = trim($_POST["gender"]);
    $phone_number      = trim($_POST["phone"]);

    if (
        empty($reg_number) ||
        empty($first_name) ||
        empty($last_name) ||
        empty($gender)
    ) {

        $error = "Please fill in all required fields.";

    }

    else {

        

        $sql = "SELECT id FROM students WHERE reg_number = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s",$reg_number);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){

            $error = "Registration number already exists.";

        }

        else{

            $sql = "INSERT INTO students
            (reg_number,first_name,last_name,gender,phone_number)

            VALUES(?,?,?,?,?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(

                "sssss",

                $reg_number,
                $first_name,
                $last_name,
                $gender,
                $phone_number

            );

            if($stmt->execute()){

                $success = "Student registered successfully.";

            }

            else{

                $error = "Failed to register student.";

            }

        }

    }

}

$sql = "SELECT * FROM students ORDER BY reg_number";
$result = $conn->query($sql);
$count = 1;

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
        <?php require "includes/alert.php";
       
        ?>
        <form action="students.php" method="POST" class="student-form">

            <div class="form-group">

                <label>Registration Number</label>

                <input
                type="text"
                name="reg_number"
                placeholder="e.g. AUCA/24/001"
                value="<?= htmlspecialchars($_POST["reg_number"] ?? '')?>"
                required>

            </div>

            <div class="form-group">

                <label>First Name</label>

                <input
                type="text"
                name="first_name"
                placeholder="Enter first name"
                value="<?= htmlspecialchars($_POST["first_name"] ?? '')?>"
                required>

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <input
                type="text"
                name="last_name"
                placeholder="Enter last name"
                value="<?= htmlspecialchars($_POST["last_name"] ?? '')?>"
                required>

            </div>

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="<?= htmlspecialchars($_POST["gender"] ?? '')?>">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>

                </select>

            </div>

           

            <div class="form-group">

                <label>Phone Number</label>

                <input
                type="text"
                name="phone"
                value="<?= htmlspecialchars($_POST["phone"] ?? '')?>"
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    
                    <th>Phone</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

            <?php while($student = $result->fetch_assoc()): ?>
                <tr>
                
                <td><?= $count++ ?></td>
                <td><?=htmlspecialchars($student["reg_number"]) ?></td>
                <td><?=htmlspecialchars($student["first_name"]) ?></td>
                <td><?=htmlspecialchars($student["last_name"]) ?></td>
                <td><?=htmlspecialchars($student["gender"]) ?></td>
                <td><?=htmlspecialchars($student["phone_number"]) ?></td>
                <td class="actions">

                        <a href="#" class="edit">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </a>

                        <a href="#" class="delete">

                            <i class="fa-solid fa-trash"></i>

                        </a>

                    </td>
                
                </tr>
             

            <?php endwhile; ?>

                

            </tbody>

        </table>

    </section>

</main>

<?php

require "includes/footer.php";

?>