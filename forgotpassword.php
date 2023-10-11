<?php


session_start();

if(isset($_POST['email'])){

    require "connection.php";

    $email = $_POST['email'];
    
    $getpassQuery = "select name, email, password from users where email = '$email'";

    $row = mysqli_query($conn, $getpassQuery);

    $user = mysqli_fetch_assoc($row);
    
    if($user['email'] == $email){
        $passwd = $user['password'];
        $name = $user['name'];

        $_SESSION['role'] = "fp";
        
        $subject = "Forgot Password [HCMS]";
        $body = "<h2>Hii ". $name."..!,<br>Thanks for using our system.<br>Login Credentials.<br> <span style='color: red'>Email : ".$email."<br>Password : ".$passwd."</span></h2>";
        include 'sendmail.php';
    }else{
        echo "<script>alert('Email not registered..'); location.href='login.html'; </script>";
    }
}else{
    header("locatoin:forgotpassword.html");
}


?>