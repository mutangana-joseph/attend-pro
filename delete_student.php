<?php

require "config/db.php";

if($_SERVER["REQUEST_METHOD"] ==="GET"){
    $id=$_GET["id"];

    $sql = "delete from students where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: students.php");
        exit();
    }
}

?>