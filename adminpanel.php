<?php

session_start();
require "connection.php";
if($_SESSION['admin_login'] == "Active"){
?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Admin Panel</title>
		<!-- CSS stylesheets -->
		<style>
		/* Global styles */

	body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
	}

	nav {
		background-color: #2EC2C0;
		color: #fff;
	}

	nav ul {
		margin: 0;
		padding: 0;
		list-style: none;
		display: flex;
		justify-content: flex-start;
	}

	nav li {
		margin: 0;
		padding: 0;
	}

	nav a {
		display: block;
		padding: 1rem;
		color: #fff;
		text-decoration: none;
	}

	nav a:hover {
		background-color: #2EC2C0;
	}

	main {
		padding: 2rem;
	}

	h1 {
		margin: 0;
		font-size: 2rem;
	}

	.stats {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 2rem 0;
	}

	.stat {
		flex-basis: 30%;
		background-color: #2EC2C0;
		padding: 2rem;
		text-align: center;
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
	}

	.stat h2 {
		margin-top: 0;
		font-size: 1.5rem;
	}

	table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}
		th,
		td {
			text-align: left;
			padding: 8px;
		}
		th {
			background-color: #2EC2C0;
			color: white;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		hr {
			border: none;
			border-top: 1px solid #ccc;
			margin-top: 10px;
		}

	footer {
		//background-color: #2EC2C0;
		color: #fff;
		text-align: center;
		padding: 1rem;
	}
	h1 {
				text-align: center;
				color: #333;
			}
	h2{
				text-align: center;
				color: #fff;
				padding: 10px;
			}

	/* Responsive styles */

	@media screen and (max-width: 768px) {
		main {
			padding: 1rem;
		}
		
		.stats {
			flex-wrap: wrap;
		}
		
		.stat {
			flex-basis: 100%;
			margin-bottom: 1rem;
		}
	}
	</style>

	</head>
	<body>
		<!-- Navigation bar -->
		<nav>
			<ul>
				
				<li><a href="displaystud.php">Students</a></li>
				<li><a href="displayworkers.php">Workers</a></li>
				<li><a href="admin_logout.php">Log Out</a></li>
			</ul>
		</nav>
		
		<!-- Content area -->
		<main>
			<!-- Page title -->
			<h1>complaints</h1>
			
			<!-- Statistics -->
			<div class="stats">
				<div class="stat">
					<h2>Total 
					<p id="tc"></p></h2>
				</div>
				<div class="stat">
					<h2>UnSeen
					<p id="rc"></p></h2>
				</div>
				<div class="stat">
					<h2>Completed
					<p id="cc"></p></h2>
				</div>
			</div>
			
			<!-- Recent orders table -->
			
		</main>
		
		<!-- Footer -->
		<footer>
			<h1>Complaint Details</h1>
		</footer>
	</body>



	</html>


	<?php
		
	
	$sql = "SELECT * FROM complaints";

	$result = mysqli_query($conn, $sql);

	?>
	<!-- // Display the complaints in an HTML table -->

	<table>
	<th>Student Name</th>
	<th>Complaint Type</th>
	<th>Complaint Details</th>
	<th>Date Submitted</th>
	<th>Action</th>
	<?php
	$j = 0;
	$k = 0;

	while ($row = mysqli_fetch_assoc($result)) {
	$sid = $row["sid"];
	$getNameQuery = "select name, room_no from users where sid = $sid";
	$user = mysqli_query($conn, $getNameQuery);
	$user = $user->fetch_assoc();
	echo "<tr>";
	echo "<td>" . $user['name'] . "</td>";
	echo "<td>" . $row["type"] . "</td>";
	echo "<td>" . $row["Detail"] . "</td>";
	echo "<td>" . $row["Date"] . "</td>";
	//echo "<td>" . $row["cid"] . "</td>";
	
	$_SESSION['cid'] = $row["cid"];
	
	$room =  $user['room_no'];
	if($row['Action'] == "Take Action"){
		echo "<td>
		<a href='sendmail.php?cid= ".$row["cid"]."&complaint=".$row["Detail"]."&room=".$room." '>". $row["Action"] ."
		</td>";
	}else if($row['Action'] == "In Progress"){
		echo "<td>In Progress</td>";
	}
	else{
		echo "<td>Resolved</td>";
	}
	

	echo "</tr>";
	$string1 = $row["Action"];
	$string2 = "Take Action";

	if ($string1 == $string2) {
		$k=$k+1;
	} else {
		echo "";
	}
	$j=$j+1;
	}
	$l = $j-$k;
	echo "</table>";
	echo "<script>document.getElementById('tc').innerHTML = '".$j."';</script>";
	echo "<script>document.getElementById('rc').innerHTML = '".$k."';</script>";
	echo "<script>document.getElementById('cc').innerHTML = '".$l."';</script>";

	$result->close();
	$conn->close();
	
}else{
	header("location:h1.html");
}
?>