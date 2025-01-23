<?php 
/*
not paid
shipped
delivered
*/

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM orders_items WHERE order_id=?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
}

else{
    header('location: account.php');
    exit;
}


function calculateTotalOrderPrice($order_details){
  $total = 0;

  foreach($order_details as $row){

    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];

    $total = $total + ($product_price * $product_quantity);


  }

  return $total;
}

?>





<?php include('layouts/header.php'); ?>

    <!-- Order Details -->
    <section id="orders" class="orders container my-5 py-3" >
        <div class="container mt-5" style="padding: 20px;" >
          <h2 class="font-weight-bold text-center" style="font-family: Poppins;" >Order Details</h2>
          <hr class="mx-auto" style="border: 4px solid coral; width: 3%;">

          <table class="mt-5 pt-5" style="width: 100%; border-collapse: collapse;">
            <tr>
              <th style="text-align: left; padding: 5px 10px; color: white; background-color: coral;">Product</th>
              <th style="text-align: center; padding: 5px 10px; color: white; background-color: coral;">Price</th>
              <th style="text-align: right; padding: 5px 10px; color: white; background-color: coral;">Quantity</th>
            </tr>
            
            <?php foreach($order_details as $row){ ?>

             <tr>
              <td style="padding: 10px 20px; float:left;" >
                <div class="product-info" >
                    <img src="assets/imgs/<?php echo $row['product_image']; ?>" style="width: 80px; height: 80px;" >
                    <div>
                        <p class="mt-3" ><?php echo $row['product_name']; ?></p>
                    </div>
                </div>
              </td>

              <td style=" text-align:center; padding: 10px 20px;">
                <span>$<?php echo $row['product_price']; ?></span>
              </td>

              <td style=" text-align:right; padding: 10px 20px;">
                <span><?php echo $row['product_quantity']; ?></span>
              </td>

             
            </tr>

            <?php } ?>
          </table>
          
          <?php 
          
          if($order_status == "not paid"){?>
          <form style="float: right;" method="post" action="payment.php">
          <input type="hidden" value="<?php echo $order_total_price; ?>" name="order_total_price">
          <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
        <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
    </form>

          <?php } ?>
          
          
        </div>
      </section>



      <?php include('layouts/footer.php'); ?>