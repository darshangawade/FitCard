<?php
// include('connection/db.php');
//   session_start();
//   if($_SESSION['doc_mail']==true){
//     $doc_mail = $_SESSION['doc_mail'];
    
//   }else{
//     header('location:doc_login.php');
//   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Fit Card</title>
  

  <!-- Favicons -->
  <link href="assets/img/tab_logo.png" rel="icon">
  <link href="assets/img/tab_logo.png" rel="">
  <?php include("links.php");?>
  

  
</head>

<body>
  <!-- ========Nav Bar========== -->
  <?php include("nav.php");?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">


        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Fit Card ID</label>
                <input type="text" class="form-control" name="card_id"  placeholder="Enter 8 digit Fit Card ID here" required>
            </div>
           
          <div data-aos="fade-up" data-aos-delay="800">
            <input  class="btn-get-started scrollto" id="submit"  name="submit" type="submit" > or	
            <a href=""  class="btn-get-started scrollto">Scan Fit Card</a>
          </div>
        </form> 
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/jodi.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->


  

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</main>
  

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
  
</html>
<?php

include('connection/db.php');
if(isset($_POST['submit'])) {
  $card_id = $_POST['card_id'];
  
  $query = mysqli_query($conn, "select * from fit_card_request where fit_id=$card_id");
  if($query){
  if(mysqli_num_rows($query)>0){
   
    echo "<script>window.location.href  = 'send_otp.php?fcid=$card_id';</script>";


  } else {
    echo "<script>alert('Invalid Fit Card ID, please try again!')</script>";
  }

}
}

?>




