<?php
session_start();

$pageTitle = "Login";
$cssFile = "auth.css";

require "includes/header.php";
require "config/db.php";
require "includes/functions.php";
$error = "";



if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if(empty($email) || empty($password)){
        $error = "please enter your email and password";
    }
    else{
        
        $sql = "select * from users where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            $hashed_password = $user["password"];

            if(!password_verify($password, $hashed_password)){
                $error = "Invalid password ";
                
            }
            else{
                $_SESSION["id"] = $user["id"];
                $_SESSION["name"] = $user["first_name"];
                header("Location: dashboard.php");
                exit();
            }
        }
        else{
            $error = "Account not found";
        }
       
    }
}

?>



<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">

            <i class="fa-solid fa-graduation-cap"></i>

            <h1>AttendPro</h1>

            <p>Student Attendance Management System</p>

        </div>

        <?php if(!empty($error)): ?>
            <div class="error-box">
            <i class="fa-solid fa-circle-xmark"></i>

            <div>

                <h3>Login Failed</h3>

                <p><?= htmlspecialchars($error) ?></p>

            </div>


            </div>
            <?php endif; ?>

        <form action="login.php" method="POST">

            <div class="form-group">

                <label>Email Address</label>

                <input
                type="email"
                name="email"
                placeholder="Enter your email"
                value="<?= htmlspecialchars($_POST["email"] ?? '')?>"
                required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required>

            </div>

            <button type="submit" class="btn auth-btn">

                <i class="fa-solid fa-right-to-bracket"></i>

                Login

            </button>

        </form>

        <div class="auth-footer">

            Don't have an account?

            <a href="signup.php">Create Account</a>

        </div>

    </div>

</div>

