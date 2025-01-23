<?php
include('server/connection.php');
if(isset($_GET['product_id'])){

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

  $product_id = $_GET['product_id'];
  $stmt -> bind_param("i",$product_id);
$stmt->execute();

$products = $stmt->get_result();
}
else{
  header('location: index.php');
}
?>

<?php include('layouts/header.php'); ?>


<!-- Single Product -->
      <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

        <?php while($row = $products->fetch_assoc()) { ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                    </div>

                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
                    </div>

                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
                    </div>

                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img">
                    </div>

                </div>
            </div>

            
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h6 style="font-family: Poppins;"><?php echo $row['product_category'] ?></h6>
                <h3 class="py-4" style="font-family: Poppins;"><?php echo $row['product_name'] ?></h3>
                <h2 style="font-family: Poppins;">$<?php echo $row['product_price'] ?></h2>

                <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                <input type="number" name="product_quantity" value="1">
                <button class="add-to-cart-btn" type="submit" style="font-family: Poppins;" name="add_to_cart">Add To Cart</button>
                </form>


                <h4 class="mt-5 mb-5" style="font-family: Poppins;">Product Details</h4>
                <span><?php echo $row['product_description'] ?></span>
            </div>

            <?php } ?>
        </div>
      </section>

       <!-- Related Products -->
       <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3 style="font-family: Poppins;">Related Products</h3>
          <hr style="border: 5px solid orangered; width: 3%; margin: 0 auto;">
        </div>

        <div class="row text-center mx-auto container-fluid">
        <?php include('server/get_featured_products.php')?>
        <?php while($row = $featured_products -> fetch_assoc()) { ?>

          <div class="product col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" style="height: 80%;" src="assets/imgs/<?php echo $row['product_image'] ?>">

            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>

            <h5 class="p-name" style="font-family: Poppins;"><?php echo $row['product_name'] ?></h5>
            <h4 class="p-price" style="font-family: Poppins;">$ <?php echo $row['product_price'] ?></h4>
            <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn" style="font-family: Poppins;">Buy Now</button></a>
          </div>

          <?php } ?>

          
        </div>

      </section>


      <!-- Footer -->
      <footer class="mt-5 py-5" style="background-color: #1b1b1b ; color: darkgrey;">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img src="assets/imgs/logo.jpg" style="width: 40%;">
        <p class="pt-3">We provide the best products for the most affordable prices</p>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h4 class="pb-2" style="font-family: Poppins;"><b>Featured</b></h4>
        <ul class="text-uppercase">
          <li><a href="#">men</a></li>
          <li><a href="#">women</a></li>
          <li><a href="#">boys</a></li>
          <li><a href="#">girls</a></li>
          <li><a href="#">new arrivals</a></li>
          <li><a href="#">clothes</a></li>
        </ul>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h4 class="pb-2" style="font-family: Poppins;"><b>Contact Us</b></h4>
        <ul class="text-uppercase">
          <li><h4 style="font-family: Poppins;"><b>ADDRESS</b></h4></li>
          <li>1234 Street Name, City</li>
          <br>
          <li><h4 style="font-family: Poppins;"><b>PHONE</b></h4></li>
          <li>123 456 7890</li>
          <br>
          <li><h4 style="font-family: Poppins;"><b>EMAIL</b></h4></li>
          <li>info@email.com</li>
        </ul>
    </div>

    
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h4 class="pb-2" style="font-family: Poppins;"><b>INSTAGRAM</b></h4>
      
  </div>
    <div class="copyright" style="padding: 0px 0px 0px 314px;">
      <p style="float: left;">eCommerce @ 2025 All Rights Reserved</p>
      <a href="#" style="float: left; padding: 0px 0px 0px 70px;"><i class="fa-brands fa-facebook"></i></a>
      <a href="#" style="float: left; padding: 0px 0px 0px 20px;"><i class="fa-brands fa-instagram"></i></a> 
      <a href="#" style="float: left; padding: 0px 0px 0px 20px;"><i class="fa-brands fa-twitter"></i></a>
    </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
   var mainImg = document.getElementById("mainImg");
   var smallImg = document.getElementsByClassName("small-img");
   
   for (let i = 0; i < 4; i++) {
    smallImg[i].onclick = function () {
        mainImg.src = smallImg[i].src;
    }
   }

</script>
</body>
</html>