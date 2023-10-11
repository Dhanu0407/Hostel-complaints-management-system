<?php

require "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $room_no = $_POST["room_no"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    $gender = $_POST["gender"];


    // Validate form data (you can add more validation as per your requirements)
    if (empty($name) || empty($room_no) || empty($email) || empty($password) || empty($phone_number) || empty($gender)) {
        // echo '<script>alert(1)</script>';        
    } else {        
        // Insert data into database
        $sql = "INSERT INTO users (name, room_no, email, password, phone_number, gender) VALUES ('$name', '$room_no', '$email', '$password', '$phone_number', '$gender')";
        if (mysqli_query($conn, $sql)) {

            mysqli_close($conn);
            echo "<br><br><br><br><br><br><h2><center>Registration Successful</h2></center>";
            header("refresh:3;url=h1.html");
        exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            mysqli_close($conn);
        }        
    }
}
?>
