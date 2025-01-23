<?php include('layouts/header.php'); ?>
 
 
 
 
 <!-- Home -->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span style="color: darkblue;">Best Prices</span> This Season</h1>
            <p>Eshop offers the best products for the most affordable prices</p>
            <a href="shop.php"><button class="w3-button w3-black" style="padding: 15px 25px 15px 25px;">SHOP NOW</button></a>
        </div>
      </section>


      <!-- Featured -->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3 style="font-family: Poppins;">Our Featured</h3>
          <hr style="border: 5px solid orangered; width: 3%; margin: 0 auto;">
          <p style="margin: 12px 0px 0px 0px;">Here you can check out our amazing Clothes</p>
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

      <!-- Banner -->
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h4 style="font-family: Poppins;">MID SEASON'S SALE</h4>
          <h1 style="font-family: Poppins;">Autumn Collection <br> UP to 30% OFF</h1>
          <a href="shop.php"><button class="text-uppercase shop-btn">Shop Now</button></a>
        </div>
      </section>

      <!-- Clothes -->
      <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3 style="font-family: Poppins;">Suits</h3>
          <hr style="border: 5px solid orangered; width: 3%; margin: 0 auto;">
          <p style="margin: 12px 0px 0px 0px;">Here you can check out our amazing Clothes</p>
        </div>

        <div class="row text-center mx-auto container-fluid">
        <?php include('server/get_suits.php')?>
        <?php while($row = $suits_products -> fetch_assoc()) { ?>

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

      <!-- Watches -->
      <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3 style="font-family: Poppins;">Watches</h3>
          <hr style="border: 5px solid orangered; width: 3%; margin: 0 auto;">
          <p style="margin: 12px 0px 0px 0px;">Here you can check out our amazing Watches</p>
        </div>

        <div class="row text-center mx-auto container-fluid">
        <?php include('server/get_watches.php')?>
        <?php while($row = $watch_products -> fetch_assoc()) { ?>

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

      <!-- Shoes -->
      <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3 style="font-family: Poppins;">Shoes</h3>
          <hr style="border: 5px solid orangered; width: 3%; margin: 0 auto;">
          <p style="margin: 12px 0px 0px 0px;">Here you can check out our amazing Shoes</p>
        </div>

        <div class="row text-center mx-auto container-fluid">
        <?php include('server/get_shoes.php')?>
        <?php while($row = $shoes_products -> fetch_assoc()) { ?>

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
      <?php include('layouts/footer.php');?>
