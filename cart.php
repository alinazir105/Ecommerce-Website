<?php 

session_start();

if(isset($_POST['add_to_cart'])){

  if(isset($_SESSION['cart'])){
    //if user has already added a product to cart
     $products_array_ids = array_column($_SESSION['cart'],"product_id"); //returns array with all product ids
    
     if(!in_array($_POST['product_id'], $products_array_ids)){
      //if product has been added to cart or not
      
      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity']
      );
  
      $_SESSION['cart'][$product_array['product_id']] = $product_array;

     }
     else{
      //product has already been added
      echo '<script>alert("Prodcut was already added to cart")</script>';
     }
  }
  else{
    //if this is the first product

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_image' => $product_image,
      'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product_array;
    //[ product id will be used to recognize the product array ]
  }

  //calculate total
  calculateTotalCart();
}

elseif(isset($_POST['remove_product'])){
  //remove product from cart
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  //calculate total
  calculateTotalCart();
}

elseif((isset($_POST['edit_quantity']))){
  //we get id and quantity from the form 
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  //we get the product array from the session
  $product_array = $_SESSION['cart'][$product_id];

  //update product quantity
  $product_array['product_quantity'] = $product_quantity;
  
  //return array back to its place
  $_SESSION['cart'][$product_id] = $product_array;

  //calculate total
  calculateTotalCart();
}

else{
  //header('location: index.php');
}

function calculateTotalCart(){
  $total = 0;
  foreach($_SESSION['cart'] as $key => $value){

    $product = $_SESSION['cart'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total = $total + ($price * $quantity);
  }

  $_SESSION['total'] = $total;
}

?>

<?php include('layouts/header.php'); ?>

      <!-- Cart -->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde" style="font-family: Poppins;">Your Cart</h2>
            <hr style="border: 5px solid orangered; width: 3%;">
        </div>

        <p class="text-center" style="color: red;">
          <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
        </p>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <!-- First Product -->
           <?php foreach($_SESSION['cart'] as $product_id => $product_array){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $product_array['product_image']; ?>">
                        <div>
                          <p><?php echo $product_array['product_name']; ?></p>
                        <small><span>$</span><?php echo $product_array['product_price']; ?></small>
                        <br>

                        <form action="cart.php" method="post">
                          <input type="hidden" name="product_id" value="<?php echo $product_array['product_id']; ?>">
                        <input type="submit" class="remove-btn" name="remove_product" value="remove" style="color: coral; text-decoration: none; font-size: 14px; background-color: white; border: none; width: 100%; ">
                        </form>
                        
                </div>
                    </div>
                </td>

                <td>
                    <form action="cart.php" method="post" style="display: flex; align-items: center; " >
                      <input type="hidden" name="product_id" value="<?php echo $product_array['product_id']; ?>">
                      <input type="number" name="product_quantity" value="<?php echo $product_array['product_quantity']; ?>">
                      <input type="submit" class="edit-btn" value="edit" name="edit_quantity" style="color: coral; text-decoration: none; background-color: white; border: none;">
                    </form>
                </td>

                <td>
                    <span>$</span>
                    <span class="product-price"><?php echo $product_array['product_quantity'] * $product_array['product_price']; ?></span>
                </td>
            </tr>

            <?php } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td style="float: right;">$<?php echo $_SESSION['total'] ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">

          <form action="checkout.php" method="post" >

          <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout" style="width: 100%; padding: 10px 20px 35px 10px;" >
          
        </form>
            
        </div>
      </section>

      <?php include('layouts/footer.php'); ?>