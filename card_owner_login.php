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
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" name="pass"  placeholder="Enter your password here" required>
            </div>
            
           
          <div data-aos="fade-up" data-aos-delay="800">
            <input  class="btn-get-started scrollto" id="submit"  name="submit" type="submit" > 

          </div>
        </form> 
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/pat.png" class="img-fluid animated" alt="">
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
error_reporting(E_ERROR | E_PARSE);
session_start();
include('connection/db.php');
if(isset($_POST['submit'])) {
  $card_id = $_POST['card_id'];
  $pass = $_POST['pass'];
  $query = mysqli_query($conn, "select * from fit_card_request where fit_id ='$card_id' and pass='$pass'");
  if($query){
        if(mysqli_num_rows($query)>0){
            $_SESSION['fit_pat_own'] = $card_id;
            $_SESSION['start_own'] = time();
             // Ending a session in 5 minutes from the starting time.
             $_SESSION['expire_own'] = $_SESSION['start_own'] + (30 * 60);
             header("location:fit_card_owner.php");
             
        } else {
            echo "<script>alert('invalid Fit Card ID or Password, please try again!')</script>";
        }

 

}
}

?>




