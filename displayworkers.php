<!DOCTYPE html>
<html>
  <head>

    <title>Students</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
      }
      
      
      h1 {
            text-align: center;
            color: #333;
        }
        h2{
            text-align: center;
            color: #2EC2C0;
            padding: 10px;
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
      
        input[type="Button"] {
            background-color: #2EC2C0;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="Button"]:hover {
            background-color: #3e8e41;
        }

      
    </style>
  </head>
  <!DOCTYPE html>
<body>
	<table>
		<thead>
			<tr>
				<th><h1>Workers Details..</h1></th>				
			</tr>
		</thead>
		<tbody>
			<?php
				require "connection.php";

				// SQL query to select all records from the table
				$sql = "SELECT * FROM workers";

				// Execute the query and get the result set
				$result = mysqli_query($conn, $sql);
                echo "<table>";
                echo "<h2><tr><th>Id</th><th>Work Name</th><th> Name</th><th>Gmail</th><th>Action</th></tr></h2>";
				// Loop through the result set and display the data in the table
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Id'] . "</td>";
            echo "<td>" . $row['Workname'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Gmail'] . "</td>";
            echo "<td><a href='update.php?id=" . $row['Id'] . "'>Update</a></td>";
            echo "</tr>";
          }        					
				} else {
					echo "No records found.";
				}

				// Close the database connection
				mysqli_close($conn);
			?>
		</tbody>
	</table>
  <center><br><br><a href="adminpanel.php"><input type="Button" value="Back"></a></center>

</body>
</html>
