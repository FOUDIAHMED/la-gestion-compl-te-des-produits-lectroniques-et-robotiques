<?php
session_start();
include 'db_connection.php';
if(!isset($_SESSION['uname'])||!isset($_SESSION['pass'])){
	header('location:signin.php?error=ududjdus');
}else{


// Validate User
if (isset($_POST['validate'])) {
    $userId = $_POST['validate'];
    $userId = mysqli_real_escape_string($conn, $userId);

    $sql = "UPDATE users SET valide = 1 WHERE id = $userId";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
if (isset($_POST['be_admin'])) {
    $userId = $_POST['be_admin'];
    $userId = mysqli_real_escape_string($conn, $userId);
    $ad="admin";

    $sql = "UPDATE users SET ro_le = \"$ad\"  WHERE id = $userId";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


// Delete User
if (isset($_POST['delete'])) {
    $userId = $_POST['delete'];
    // Add deletion logic here (delete the user record from the database)
    // Example: $sql = "DELETE FROM users WHERE id = $userId";
    

    // Sanitize user input to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $userId);

    // Construct the SQL query
    $sql = "DELETE FROM users WHERE id = $userId";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Redirect to the admin.php page
        header("Location: admin.php");
        exit();
    } else {
        // Handle the case when the query fails
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}


// Fetch Users from Database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Progressus - Free business bootstrap template by GetTemplate</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
    .validate-btn {
        background-color: #4CAF50;
        color: white;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    .admin-btn {
        background-color: #2196F3;
        color: white;
    }
    button {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-right: 5px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

</head>

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li ><a href="index.php">Home</a></li>
					<li ><a href="list.php">list des utilisateurs</a></li>
					<li ><a href="categorie.php">Categories</a></li>
					<li ><a href="produit.php">Produits</a></li>
					<li><a class="btn" href="logout.php">logout</a></li>
				</ul>
			</div>
		</div>
	</div>
    <header id="head">
		<div class="container">
			<div class="row">
				 <h1 class="lead">ElectroNacer</h1>
				
			</div>
		</div>
	</header>

    <h1>User List</h1>

    <table >
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <form method='post'>
                    <button class='validate-btn' type='submit' name='validate' value='" . $row['id'] . "'>Validate</button>
                    <button class='delete-btn' type='submit' name='delete' value='" . $row['id'] . "'>Delete</button>
                    <button class='admin-btn' type='submit' name='be_admin' value='" . $row['id'] . "'>Be Admin</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>

    </table>

</body>
</html>

<?php
$conn->close();
?>
<?php }