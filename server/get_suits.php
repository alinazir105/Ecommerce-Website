<?php 

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='suits' LIMIT 4");

$stmt->execute();

$suits_products = $stmt->get_result();

?>