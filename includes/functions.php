<?php

function emailExist($conn, $email){
    $sql = "select id from users where email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

function deleteUsers($conn){
    $sql = "delete from users";
    $stmt = $conn->prepare($sql);
    return $stmt->execute();
}

?>