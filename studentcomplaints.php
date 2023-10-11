<?php
session_start();

if($_SESSION['sid'] != null){
?>

  <!DOCTYPE html>
  <html>
    <head>

      <title>Student Complaint Dashboard</title>
      <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f1f1f1;
        }
        header {
          background-color: #2EC2C0;
          color: white;
          padding: 20px;
          
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
            box-shadow: 0 0 10px rgba(0,0,0,0.3);


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
        textarea {
          display: block;
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
          margin-bottom: 10px;
          font-size: 16px;
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
        nav {
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  nav li {
    margin: 0 10px;
  }

  nav a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 10px;
    border-radius: 4px;
  }

  nav a:hover {
    background-color: #3e8e41;
  }

      </style>
    </head>
    <body>
    
  <header>
    <center><h1>Student Complaint Dashboard</h1>
    <h3>Submit a New Complaint: </h3>
  </center>
    <nav>
      <ul>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      </nav>

  </header>

  <br>
  <form method="post" action="studentcomplaints.php">
        <label for="complaint-type">Complaint Type:</label>
        <select id="complaint-type" name="complaint-type">
          <option value="Plumber">Plumber</option>
          <option value="Electrician">Electrician</option>
          <option value="CarPenter">CarPenter</option>
          <option value="other">Other</option>
        </select><br>
        <label for="complaint-details">Complaint Details:</label><br>
        <textarea id="complaint-details" name="complaint-details" rows="5" cols="50"></textarea><br><br>
        <button type="submit">Submit Complaint</button>
  </form>
      <hr>
      <h2>Recent Complaints</h2>
      <p style="text-align: center; color:blue;">If Your Complaint is resolved then Press the <b>Resolved</b> Button</p>
    </body>
  </html>

  <?php
  // Check if the form has been submitted
  $sid = $_SESSION['sid'];
  require "connection.php";

  $sql = "SELECT *FROM complaints WHERE sid = $sid";
  $sql2 = "SELECT *FROM users WHERE sid = $sid";
  $result = mysqli_query($conn, $sql);

  // Display the complaints in an HTML table
  echo "<table>";
  echo "<th>Complaint Type</th><th>Complaint Details</th><th>Date Submitted</th><th>Status</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["type"] . "</td>";
    echo "<td>" . $row["Detail"] . "</td>";
    echo "<td>" . $row["Date"] . "</td>";
    $action = $row["Action"];
    if($action == "Take Action"){
      echo "<td>Submitted</td>";
    }else if($action == "In Progress"){
        ?>
        <td>
          <a href="studentcomplaints.php?cid=<?php echo $row['cid']; ?>"><button type="submit">Resolved</button></a>        
        </td>
        <?php
    }
    else{
      echo "<td>Resolved</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
  
  if(isset($_GET['cid'])){

    $cid = $_GET['cid'];

    // Update the complaint with the given id
    $sql = "UPDATE complaints SET Action='Completed' WHERE cid=$cid";
    $result = mysqli_query($conn, $sql);
    if($result != null){
      echo "<script>alert('Action taken Successfully'); </script>";
    }else{
      echo "<script>alert('Something Went Wrong'); </script>";
    }
  }


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Retrieve the complaint data from the form
    
    $complaint_type = $_POST['complaint-type'];
    $complaint_details = $_POST['complaint-details'];
    
    // Get the current date and time
    date_default_timezone_set('UTC');
    $current_date = date('Y-m-d');
    // Prepare the SQL statement to insert the complaint data into the database
    $action = "Take Action";
    $stmt = $conn->prepare("INSERT INTO complaints (sid, Type, Detail, Date,Action) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $sid, $complaint_type, $complaint_details, $current_date,$action);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
      echo "<script>alert('Complaint submitted successfully!'); location.href = 'studentcomplaints.php'; </script>";
    } else {
      echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $conn->close();
    
  }
}else{
  header("location:h1.html");
} 
?>