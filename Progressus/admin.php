<?php
include 'db_connection.php';

// Validate User
if (isset($_POST['validate'])) {
    $userId = $_POST['validate'];
    // Add validation logic here (update the user record in the database)
    // Example: $sql = "UPDATE users SET validated = 1 WHERE id = $userId";
    // Execute the SQL statement
    // Redirect or refresh the page after validation
    header("Location: admin.php");
    exit();
}

// Delete User
if (isset($_POST['delete'])) {
    $userId = $_POST['delete'];
    // Add deletion logic here (delete the user record from the database)
    // Example: $sql = "DELETE FROM users WHERE id = $userId";
    // Execute the SQL statement
    // Redirect or refresh the page after deletion
    header("Location: admin.php");
    exit();
}

// Fetch Users from Database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <h2>User List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        // Display User List
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <form method='post'>
                        <button type='submit' name='validate' value='" . $row['id'] . "'>Validate</button>
                        <button type='submit' name='delete' value='" . $row['id'] . "'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>

    </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
