<?php
$hostaname = "localhost";
$username = "root";
$password = "";
$databse = "attendpro";



try{
    $conn = new mysqli($hostaname, $username, $password, $databse);

}

catch(mysqli_sql_exception $e){
    
    die("Conection failed");
    
}

?>


