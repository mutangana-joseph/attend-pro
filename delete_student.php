<?php

require "includes/db.php";

if($_SERVER["REQUEST_METHOD"] ==="GET"){
    $id=$_GET["id"];

    $sql = "delete from students where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

?>