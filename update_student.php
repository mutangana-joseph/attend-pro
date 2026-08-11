<?php
require "includes/session.php";


$pageTitle = "Update Students";
$page = "students";
$cssFile = "student.css";


require "includes/header.php";
require "includes/sidebar.php";
require "config/db.php";

$success = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] === "GET"){
    $id=$_GET["id"];

    $sql = "select * from students where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $student = $stmt->get_result();
    if($student->num_rows > 0){
        $row = $student->fetch_assoc();
        
        $id=$row["id"];
        $reg_number = $row["reg_number"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $gender = $row["gender"];
        $phone = $row["phone_number"];
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reg_number = trim($_POST["reg_number"]);
    $student_id = trim($_POST["id"]);
    $first_name = trim($_POST["first_name"]);
    $last_name  = trim($_POST["last_name"]);
    $gender     = trim($_POST["gender"]);
    $phone_number = trim($_POST["phone"]);

    if (
        empty($reg_number) ||
        empty($first_name) ||
        empty($last_name) ||
        empty($gender)
    ) {

        $error = "Please fill in all required fields.";

    }

    

    else{

        $sql = "update students set
        first_name = ? , last_name = ?, gender =?, phone_number =? where id=?
        ";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(

            "sssss",

            
            $first_name,
            $last_name,
            $gender,
            $phone_number,
            $student_id

        );

        if($stmt->execute()){

            $success = "Change saved successfully.";
            header("Location: students.php");

        }

        else{

            $error = "Failed to update student.";

        }

    }

}





?>




<main class="main-content">

    <div class="page-header">

        <div>
            <h1>Update Student Registration</h1>
            <p>Correct mistakes that happened during students register</p>
        </div>

        <a href="attendance.php" class="btn">
            <i class="fa-solid fa-calendar-check"></i>
            Take Attendance
        </a>

    </div>

    <section class="card">

        <div class="section-title">

            <h2>
                <i class="fa-solid fa-pen-to-square"></i>
                Update Student
            </h2>

        </div>
        <?php require "includes/alert.php";?>

        <form action="" method="POST" class="student-form">
        <input
                type="text"
                name="id"
                
                value="<?= htmlspecialchars($id)?>"
                required hidden>

            <div class="form-group">

                <label>Registration Number</label>

                <input
                type="text"
                name="reg_number"
                placeholder="e.g. AUCA/24/001"
                value="<?= htmlspecialchars($reg_number)?>"
                required readonly>

            </div>

            <div class="form-group">

                <label>First Name</label>

                <input
                type="text"
                name="first_name"
                placeholder="Enter first name"
                value="<?= htmlspecialchars($first_name)?>"
                required>

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <input
                type="text"
                name="last_name"
                placeholder="Enter last name"
                value="<?= htmlspecialchars($last_name)?>"
                required>

            </div>

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="">Select Gender</option>
                    <option value ="Male" <?= $gender === "Male" ? "selected" : "" ?>>Male</option>
                    <option value ="Female" <?= $gender === "Female" ? "selected" : "" ?>>Female</option>

                </select>

            </div>

           

            <div class="form-group">

                <label>Phone Number</label>

                <input
                type="text"
                name="phone"
                value="<?= htmlspecialchars($phone) ?>"
                placeholder="07XXXXXXXX">

            </div>

            

            <div class="form-group full-width">

                <button class="btn" type="submit" id="submit">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save changes

                </button>

            </div>

        </form>

    </section>

</main>

<script>
    document.getElementById('submit').addEventListener('click', function(event){
        if(!confirm("Do you want to save the changes?")){
            event.preventDefault();
        }
    })
</script>
    
<?php

require "includes/footer.php";

?>