<?php
include('connection/db.php');
  session_start();
  if($_SESSION['doc_mail']==true){
    $doc_mail = $_SESSION['doc_mail'];
    
  }else{
    header('location:doc_login.php');
  }
?>

<?php
include('connection/db.php');

$query =  mysqli_query($conn,"select * from  doctor where doc_mail= '$doc_mail'");
while($row= mysqli_fetch_array($query)) {
  $doc_name = $row['doc_name'];
}
session_start();
if(isset($_GET["fcid"])){
    $fit_id=$_GET["fcid"];
    $query = mysqli_query($conn,"select * from fit_card_request where fit_id='$fit_id'");
    $row = mysqli_fetch_array($query);
    $cont = $row['contact'];
    $name = $row['name'];
    $pat_mail = $row['email'];
    $otp = rand(1000,9999);   //generating 4-digit otp



    // ================================= send sms=========================================


    $contact='91'.$cont;   //contact from form and adding '91' to it
    $hash = "0103767c1b4c52d07f0cfc3ddb06414e772e1551a73c660e8218a46edfb7b915";   //hash key which you will get after creating an account from api
    $test = "0";  //keep this as it is
    $sender = "TXTLCL"; // This is who the message appears to be from.
    $numbers = "$contact"; // A single number or a comma-seperated list of numbers
    $message = "Hello,".$name." Hi, ".$doc_name." need to access your fit card, This is your Fit Card OTP : ".$otp;   //message which is to be displayed in the sms
    $message = urlencode($message);
    $username = 'zeelmehta19.zm@gmail.com';
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.textlocal.in/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    // echo $result;
    $json = json_decode($result, true);



    // ===================send mail=========================

    require("PHPMailer/src/PHPMailer.php");
      require("PHPMailer/src/SMTP.php");
      require("PHPMailer/src/Exception.php");
        
      $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->setFrom('admin@example.com');
        $mail->addAddress($pat_mail);
        $mail->Subject = 'Fit Card Verification Code';
        $mail->Body = 'Hello,'.$name.'. '.$doc_name.' Want to access your Fit Card; verification code is :'.$otp;
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->Username = 'medtechsolutions.vit@gmail.com';
        $mail->Password = 'medtech@1234';


    if($json['status']=="success" or $mail->send())
    {
        $_SESSION['superhero'] = $otp;
        $_SESSION['fitid'] = $fit_id;
        echo "<script>alert('OTP sent successfully on registered contact number and email ID.')</script>";   
        echo "<script>window.location.href='OTP_Validation.php';</script>";   
    }else{
        echo "<script>alert('OTP not sent!, Please try again')</script>";
    }

    
}




?>