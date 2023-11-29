<?php
include 'db_connection.php';

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['btn'])) {
    $firstname = filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $paswd = filter_var($_POST['passwd'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "INSERT INTO users(nom,prenom,username,email,mot_passe) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        $stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $paswd);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>window.location.href='signin.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }
}
?>
