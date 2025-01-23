<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['login_btn'])){
  $email = $_POST['email'];
  $password = $_POST['password']; // Not hashed

  $stmt = $conn->prepare("SELECT user_id,user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
      $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
      $stmt->store_result();
      if($stmt->num_rows() == 1){
          $stmt->fetch();

          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_name'] = $user_name;
          $_SESSION['user_email'] = $user_email;
          $_SESSION['logged_in'] = true;

          header('location: account.php?login_success=logged in successfully');
      } else {
          header('location: login.php?error=could not verify your account');
      }
  } else {
      //error
      header('location: login.php?error=something went wrong');
  }
}


?>
<!-- header -->
<?php include('layouts/header.php') ?>
<!-- Login -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5 login-container">
        <div class="image-container">
            <img src="assets/imgs/design.jpeg" style="float: left;" >
        </div>
        <div class="form-container">
            <h2 class="form-weight-bold" style="font-family: Poppins; margin: 0px 0px 24px 0px;">Login</h2>
            
            <form id="login-form" method="POST" action="login.php" style="margin: 0px 0px 0px 580px;" >
                <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
                </div>

                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include('layouts/footer.php') ?>
