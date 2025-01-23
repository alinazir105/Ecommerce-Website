<?php
session_start();

include('server/connection.php');


if(isset($_SESSION['logged_in'])){
  //if user has already registered then take user to account page
  header('location: account.php');
  exit;
}

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if ($password !== $confirmPassword) {
    //if passwords dont match
    header('location: register.php?error=passwords dont match');
  } 
  elseif (strlen($password) < 6) {
    //if password less than 6 characters
    header('location: register.php?error=password must be atleast 6 characters');
  } 
  else {
    //if there is no error
    //check whether user with this email exists already
    $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1 -> store_result();
    $stmt1->fetch();

    if ($num_rows != 0) {
      //if there is a user already registered with this email
      header('location: register.php?error=user with this email already exists');
    } 
    else {
      //if no user registered with this email
      //create a new user
      $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
    VALUES (?,?,?)");

      $stmt->bind_param('sss', $name, $email, md5($password));

      if($stmt->execute()){
        //if account was created successfully
        $user_id = $stmt->insert_id;
        $_SESSION['$user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register_success=You registered successsfully');
      }
      else{
        //account could not be created
        header('location: register.php?error=Could not create an account at the moment');
      }
    }
  }
}


?>


<?php include('layouts/header.php'); ?>

  <!-- Register -->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
    
            <img src="assets/imgs/design.jpeg" style="float: left; height: 50vh" >
        
      <div class="form-container">  
      <h2 class="form-weight-bold" style="font-family: Poppins; margin: 0px 0px 24px 0px;">Register</h2>
    </div>
    <div class="mx-auto container">
      <form id="register-form" method="post" action="register.php" style="margin: 0px 0px 0px 600px;">
        <p style="color: red;">
        <?php if (isset($_GET['error'])) {
                                  echo $_GET['error'];
                                }  ?></p>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" id="register-email" name="email" placeholder="email" required>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required>
        </div>

        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="confirmPassword" required>
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="Register">
        </div>

        <div class="form-group">
          <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
        </div>
      </form>
    </div>
    </div>
  </section>

  <?php include('layouts/footer.php'); ?>