<?php

$pageTitle = "Sign Up";
$cssFile = "auth.css";

require "includes/header.php";
require "config/db.php";
require "includes/functions.php";

$error = "";
$success = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Please enter valid email";

        }
        elseif(emailExist($conn, $email)){
            $error = "Email Exists";
            
        }
        elseif(strlen($password) < 8){
            $error = "Password to short. Try at least 5 characters";
           
        }
        elseif($password !== $confirm_password){
            $error = "Password and confirmation password did not match";

        }


        else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "insert into users(first_name, last_name, email, password) values(?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
            if($stmt->execute()){
                $success = "Lecturer $first_name was registered successfully";
                header("location: login.php");
                exit();
            }
        }
        

    }

    else{
        $error = "Form fields can't contain empty values. Password can't be space";
    }
    


}


?>



<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">

            <i class="fa-solid fa-user-plus"></i>

            <h1>Create Lecturer Account</h1>

            <p>AttendPro Student Attendance System</p>

        </div>

        <?php if(!empty($error)): ?>
<div class="error-box">

    <i class="fa-solid fa-circle-xmark"></i>

    <div>

        <h3>Registration Failed</h3>

        <p><?= htmlspecialchars($error) ?></p>

    </div>

</div>

<?php endif; ?>

<?php if(!empty($success)): ?>
<div class="success-box">

    <i class="fa-solid fa-circle-check"></i>

    <div>

        <h3>Registration Succeeded</h3>

        <p><?= htmlspecialchars($success) ?></p>

    </div>

</div>

<?php endif; ?>


       

        <form action="signup.php" method="POST">

            <div class="form-group">

                <label>First Name</label>

                <input
                type="text"
                name="first_name"
                placeholder="Enter first name"
                value="<?=htmlspecialchars($_POST["first_name"] ?? '')?>"
                required>

            </div>
            <div class="form-group">

                <label>Last Name</label>

                <input
                type="text"
                name="last_name"
                value="<?=htmlspecialchars($_POST["last_name"] ?? '')?>"
                placeholder="Enter last name"
                required>

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input
                type="email"
                name="email"
                value="<?=htmlspecialchars($_POST["email"] ?? '')?>"
                placeholder="Enter your email"
                
                required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                type="password"
                name="password"
                placeholder="Create password"
                
                required>

            </div>
            <div class="form-group">

                <label>Confirm Password</label>

                <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                
                required>

            </div>

            

            <button type="submit" class="btn auth-btn">

                <i class="fa-solid fa-user-check"></i>

                Create Account

            </button>

        </form>

        <div class="auth-footer">

            Already have an account?

            <a href="login.php">Login</a>

        </div>

    </div>

</div>

