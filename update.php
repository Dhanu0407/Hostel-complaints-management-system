<?php

require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $workname = mysqli_real_escape_string($conn, $_POST['workname']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);

    // Perform validation and sanitization here

    $sql = "UPDATE workers SET Workname='$workname', Name='$name', Gmail='$gmail' WHERE Id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: displayworkers.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM workers WHERE Id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $workname = $row['Workname'];
    $name = $row['Name'];
    $gmail = $row['Gmail'];

    // Generate HTML form here with pre-populated data
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Worker Details</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
		}

		header {
			background-color: #2EC2C0;
			color: white;
			padding: 20px;
			text-align: center;
		}

		h1 {
			text-align: center;
			color: #333;
		}

		h2 {
			text-align: center;
			color: #2EC2C0;
			padding: 10px;
		}

		form {
			max-width: 500px;
			min-height: 400px;
			margin: 0 auto;
			background-color: #fff;
			padding: 30px;
			padding-top: 30px;
			border-radius: 10px;
			margin-bottom: 20vh;
			margin-top: 5vh;
			border: 2px solid #2EC2C0;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		label {
			display: inline-block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		select,
		input[type="text"],
		input[type="email"] {
			width: 80%;
			padding: 10px;
			border: 1px solid ;
			border-radius: 3px;
			background-color: #f9f9f9;
			font-size: 16px;
			margin-bottom: 20px;
		}

		button {
			background-color: #2EC2C0;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}

		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<header>
		<h1>Update Worker Details</h1>
	</header>
	<form method="POST">
		<label for="complaint-type">Work Name:</label>
		<select id="Workname" name="workname" value="<?php echo $workname; ?>">
			<option value="Plumber">Plumber</option>
			<option value="Electrician">Electrician</option>
			<option value="CarPenter">CarPenter</option>
			<option value="other">Other</option>
		</select><br><br>
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo $name; ?>"><br><br>
		<label>Email:</label>
		<input type="email" name="gmail" value="<?php echo $gmail; ?>"><br><br>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<button type="submit">Update</button>
	</form>
</body>
</html>

<?php
}
$conn->close();
?>