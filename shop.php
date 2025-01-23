<?php

include('server/connection.php');

if(isset($_POST['search'])){
  //use the search section
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");

  $stmt->bind_param("si",$category,$price);
  
  $stmt->execute();
  
  $products = $stmt->get_result();

}
else{
  //return all products
  $stmt = $conn->prepare("SELECT * FROM products");
  
  $stmt->execute();
  
  $products = $stmt->get_result();

}

?>


<?php include('layouts/header.php'); ?>

  <div class="container-fluid" style="display: flex; flex-wrap: wrap;">
  <!-- Search -->
  <section class="my-5 pb-5 pt-1" style="flex: 1; max-width: 300px; padding-right: 20px;">
    <div class="container text-start mt-5 py-5">
      <h4 style="font-family:Poppins;">Search Products</h4>
      <hr style="border: 5px solid orangered; width: 10%;">
    </div>

    <form action="shop.php" method="post">
      <div class="row mx-auto container">
        <div class="col-lg-12 col-sm-12 col-sm-12">
          <p>Category</p>
          <div class="form-check">
            <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one">
            <label class="form-check-label" for="flexRadioDefault1">Shoes</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" value="suits" type="radio" name="category" id="category_two">
            <label class="form-check-label" for="flexRadioDefault2">Suits</label>
          </div>


          <div class="form-check">
            <input class="form-check-input" value="shirts" type="radio" name="category" id="category_three">
            <label class="form-check-label" for="flexRadioDefault3">Shirts</label>
          </div>


          <div class="form-check">
            <input class="form-check-input" value="t-shirt" type="radio" name="category" id="category_four">
            <label class="form-check-label" for="flexRadioDefault4">T-Shirt</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" value="bags" type="radio" name="category" id="category_five">
            <label class="form-check-label" for="flexRadioDefault5">Bags</label>
          </div>


          <div class="form-check">
            <input class="form-check-input" value="watches" type="radio" name="category" id="category_six">
            <label class="form-check-label" for="flexRadioDefault6">Watches</label>
          </div>
        </div>
      </div>

      <div class="row mx-auto container mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Price</p>
          <input type="range" class="form-range w-50" name="price" value="100" min="1" max="1000" id="customRange2">
          <div class="w-50">
          <span style="float: left;">1</span>
          <span style="float: right;">1000</span>
          </div>
        </div>
      </div>

      <div class="form-group my-3 mx-3">
        <input type="submit" name="search" value="Search" class="btn btn-primary">
      </div>
    </form>
  </section>




  <!-- Shop -->
  <section id="featured" class="my-5 pb-5 pt-1" style="flex: 2; padding-left: 20px;">
    <div class="container text-start mt-5 py-5">
      <h2 style="font-family: Poppins;">Our Featured</h2>
      <hr style="border: 5px solid orangered; width: 3%;">
      <p style="margin: 12px 0px 0px 0px;">Here you can check out our amazing Clothes</p>
    </div>

    <div class="row text-center mx-auto container">

      <?php while ($row = $products->fetch_assoc()) { ?>

        <div class="product col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" style="height: 60%; width: 100%; " src="assets/imgs/<?php echo $row['product_image']; ?>">

          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>

          <h5 class="p-name" style="font-family: Poppins;"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price" style="font-family: Poppins;"><?php echo $row['product_price']; ?></h4>
          <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">Buy Now</a></button>
        </div>

      <?php } ?>
    </div>
  </section>

  </div>

  <?php include('layouts/footer.php'); ?>