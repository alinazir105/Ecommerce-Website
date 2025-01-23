<?php

session_start();
include('server/connection.php');
if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirm_password = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];
  if ($password !== $confirm_password) {
    //if passwords dont match
    header('location: account.php?error=passwords dont match');
  } 
  elseif (strlen($password) < 6) {
    //if password less than 6 characters
    header('location: account.php?error=password must be atleast 6 characters');
  }
  else{
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");

    $stmt->bind_param('ss',$password, $user_email);

    if($stmt->execute()){
      header('location: account.php?message=password has been updated successfully');
    }
    else{
      header('location: account.php?message=could not update password');
    }
  } 
}


//get orders
if(isset($_SESSION['logged_in'])){

$user_id = $_SESSION['user_id'];  

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

$stmt->bind_param('i', $user_id);

$stmt->execute();

$orders = $stmt->get_result();

}

?>


<?php include('layouts/header.php'); ?>

      <!-- Account -->

      <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
              <p class="text-center" style="color: #008000;"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
              <p class="text-center" style="color: #008000;"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
                <h3 class="font-weight-bold" style="font-family: Poppins;">Account info</h3>
                <hr class="mx-auto" style="border: 4px solid coral; width: 3%;">
                <div class="account-info">
                    <p>Name: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; } ?></span></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="post" action="account.php">
                  <p class="text-center" style="color: red;" ><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                  <p class="text-center" style="color: #008000;" ><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
                    <h3 style="font-family: Poppins;">Change Password</h3>
                    <hr class="mx-auto" style="border: 4px solid coral; width: 7%;">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="account-password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="account-password-confirm" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
      </section>


      <!-- Orders -->
      <section id="orders" class="orders container my-5 py-3" >
        <div class="container mt-2">
          <h2 class="font-weight-bold text-center" style="font-family: Poppins;" >Your Order</h2>
          <hr class="mx-auto" style="border: 4px solid coral; width: 3%;">

          <table class="mt-5 pt-5" style="width: 100%; border-collapse: collapse;">
            <tr>
              <th style="text-align: left; padding: 5px 10px; color: white; background-color: coral;">Order id</th>
              <th style="text-align: center; padding: 5px 10px; color: white; background-color: coral;">Order Cost</th>
              <th style="text-align: center; padding: 5px 10px; color: white; background-color: coral;">Order Status</th>
              <th style="text-align: center; padding: 5px 10px; color: white; background-color: coral;">Order Date</th>
              <th style="text-align: right; padding: 5px 10px; color: white; background-color: coral;">Order Details</th>
            </tr>

            <?php while($row = $orders->fetch_assoc()){ ?>

             <tr>
              <td style="padding: 10px 20px;">
                <span><?php echo $row['order_id']; ?></span>
              </td>

              <td style=" text-align:center; padding: 10px 20px;">
                <span><?php echo $row['order_cost'] ?></span>
              </td>

              <td style=" text-align:center; padding: 10px 20px;">
                <span><?php echo $row['order_status'] ?></span>
              </td>

              <td style=" text-align:center; padding: 10px 20px;">
                <span><?php echo $row['order_date'] ?></span>
              </td>

              <td>
                <form method="post" action="order_details.php">
                  <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                  <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                  <input class="btn" type="submit" name="order_details_btn" value="details" style="color: white; background-color: coral; width:30%;">
                </form>
              </td>
            </tr>

            <?php } ?>
          </table>
        </div>
      </section>

      <?php include('layouts/footer.php'); ?>