<?php

  session_start();
  use PHPMailer\PHPMailer\PHPMailer;   

  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP.php";
  require_once "PHPMailer/Exception.php";

  $mail = new PHPMailer();
    
      
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "dhanashrighadage95@gmail.com";
  $mail->Password = 'hzbbubrvlovhjtih';
  $mail->Port = 465; //587
  $mail->SMTPSecure = "ssl"; //tls

  $headers = 'MIME-Version: 1.0';
  $headers = 'Content-type: text/html; charset=iso-8859-1';
  
    if(isset($_GET['cid'])){
      
      require "connection.php";

      $cid = $_GET['cid'];
      // Update the complaint with the given id
      $sql = "UPDATE complaints SET Action='In Progress' WHERE cid=$cid";
      $result = mysqli_query($conn, $sql);
      if($result != null){
        echo "<script>alert('Status Updated Successfully'); </script>";

        
        $complaint = $_GET['complaint'];
        $room = $_GET['room'];
        

          // Get Worker Details 
          $getWorkerQuery = "select id, workname, name, gmail from workers where workname = (select type from complaints where cid = $cid)";
          $row = mysqli_query($conn, $getWorkerQuery);
          $email = '';
          $id = '';
          $name = '';
          $workname = '';
          while($details = mysqli_fetch_assoc($row)){
            $id = $details['id'];
            $name = $details['name'];
            $email = $details['gmail'];
            $workname = $details['workname'];
          }

          //Email Settings
          $mail->isHTML(true);
          $mail->setFrom($email);    
          $mail->addAddress($email);

          $subject = "Complaint From Hostel Complaint Management System";
          $body = "<h2>Hii ". $name."..!,<br>Kindly resolve it as early as possible<br>Follwing is Complaint from Room Number : <b>$room</b>.<br> <span style='color: red'>". $complaint ."</span></h2>";
          

          $mail->Subject = $subject;
          $mail->Body = $body;
          $mail->header = $subject;

          if ($mail->send()) {
            echo "<script>alert('Email Sent to the ".$workname."'); location.href = 'adminpanel.php'; </script>";
          } else {
              echo "<script>alert('Something Went Wrong while sending email');</script>";
          }
        }else{
          echo "<script>alert('Something Went Wrong while Taking Action');</script>";
        }
      }
    
    
    if($_SESSION['role'] == "fp"){
      //Email Settings
      $mail->isHTML(true);
      $mail->setFrom($email);    
      $mail->addAddress($email);


      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->header = $subject;

      if ($mail->send()) {
        echo "<script>alert('Credentials Sent to the ".$email."'); location.href = 'login.html'; </script>";
      } else {
          echo "<script>alert('Something Went Wrong while sending credentials'); location.href = 'login.html'; </script>";
      }
    }
    
    $conn->close();
?>
