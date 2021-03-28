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
      $password=mysqli_real_escape_string($con,$_POST['password']);

      $userquery="select * from registration where username='$username'";
      $query=mysqli_query($con,$userquery);

      $emailcount = mysqli_num_rows($query);
      if($emailcount){
        $user_pass=mysqli_fetch_assoc($query);
        $db_pass=$user_pass['password'];

        $pass_decode = password_verify($password,$db_pass);

        if($pass_decode){
          ?>
          <script>
            location.replace("Home.php");
          </script>
          <?php
        }else{
          ?>
          <script>
            alert("Somthing Error Occurs");
          </script>
          <?php
        }
      }else{
        echo "Please enter valid Username";
      }
    }


     ?>














  <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width:400px;">
      <h4 class="title mt-3 text-center">Sign In</h4>
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
          </div>
          <input name="username" class="form-control" placeholder="Username" type="text" required>
        </div><!-----form-group-username----->

        <div class="form-group input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
          </div>
          <input name="password" class="form-control" placeholder="Password" type="password" required>
        </div><!-----form-group-repeat password----->
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success btn-block">Sign In</button>
        </div>
        <p class="text-center">Don't Have an account? <a href="SignUp.php">Sign In Here</a</p>
      </form>
    </article>
  </div>
</div>
</div>
  </div>
  </body>
</html>
