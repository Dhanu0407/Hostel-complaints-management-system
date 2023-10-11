<?php

require "connection.php";


// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform a database query to check if the entered username and password match
    $query = "SELECT * FROM admin_table WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // If a user with matching username and password is found, redirect to home page
    if ($user) {
        session_start();
        $_SESSION['admin_login'] = "Active";
        header("Location: adminpanel.php");
        exit();
    } else {
        // Display an error message if the username and password do not match
        $error = "Invalid username or password";
        echo "<br><br><br><br><br><br><h2><center>User not found</h2></center>";
        header("refresh:1;url=admin_login.html");
    }
}

// Close the database connection
$conn->close();
?>