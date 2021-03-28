
<?php
session_start();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up / Sign In form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>

    <?php
    include 'connection.php';

    if (isset($_POST['submit'])) {
      $username=mysqli_real_escape_string($con,$_POST['username']);
      $email=mysqli_real_escape_string($con,$_POST['email']);
      $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

      $pass=password_hash($password,PASSWORD_BCRYPT);
      $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

      $emailquery="select * from registration where email='$email'";
      $query=mysqli_query($con,$emailquery);

      $emailcount = mysqli_num_rows($query);
      if($emailcount>0){
        echo "Email already exists";
      }else{
        if($password === $cpassword){
          $insertquery =" insert into registration(username,email,mobile,password,cpassword) value ('$username','$email','$mobile','$pass','$cpass')";

          $iquery=mysqli_query($con,$insertquery);

          if($iquery){
            ?>
            <script>
              alert("Sign Up successfully");
            </script>
            <?php
          }else {
            ?>
            <script>
              alert("Somthing Error Occurs");
            </script>
            <?php
          }
        }else {
          ?>
          <script>
            alert("Password are not matching");
          </script>
          <?php
        }
      }
    }


     ?>














  <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width:400px;">
      <h4 class="title mt-3 text-center">Sign Up</h4>
      <form method="post">
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
          </div>
          <input name="username" class="form-control" placeholder="Full name" type="text" required>
        </div><!-----form-group-username----->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
          </div>
          <input name="email" class="form-control" placeholder="Email address" type="text" required>
        </div><!-----form-group-Email-address----->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-phone"></i></span>
          </div>
          <input name="mobile" class="form-control" placeholder="Phone number" type="text" required>
        </div><!-----form-group-Phone number----->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
          </div>
          <input name="password" class="form-control" placeholder="Create password" type="password" required>
        </div><!-----form-group-create password----->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
          </div>
          <input name="cpassword" class="form-control" placeholder="Repeat password" type="password" required>
        </div><!-----form-group-repeat password----->
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success btn-block">Create Account</button>
        </div>
        <p class="text-center">Have an account? <a href="SignIn.php">Sign In</a</p>
      </form>
    </article>
  </div>
</div>
</div>
  </div>
  </body>
</html>
