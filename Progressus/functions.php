<?php

function validateauth($username, $password) {
    include "db_connection.php";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND mot_passe=?");
    $stmt->bind_param("ss", $username, $password);

    if (!$stmt->execute()) {
        // Handle the case when the query fails
        echo "Query failed: " . $stmt->error;
        return false;
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        // Handle the case when no rows are returned
        echo "No rows returned";
        return false;
    }

    return $row['username'] === $username && $row['mot_passe'] === $password;
}

