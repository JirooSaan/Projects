<?php
session_start();
require 'db_config.php';
$err=''; $ok='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ensure user logged in
    if (!isset($_SESSION['student_id'])) { $err = 'Please login to sell items.'; }
    else {
        $seller = intval($_SESSION['student_id']);
        $name = $conn->real_escape_string($_POST['name']);
        $category = $conn->real_escape_string($_POST['category']);
        $price = intval($_POST['price']);
        $quantity = intval($_POST['quantity']);
        $condition = $conn->real_escape_string($_POST['condition']);
        $image_url = $conn->real_escape_string($_POST['image_url']);
        $desc = $conn->real_escape_string($_POST['description']);
        $date_posted = date('Y-m-d');
        $stmt = $conn->prepare("INSERT INTO products (product_id, seller_id, name, category, price, quantity, condition, image_url, description, date_posted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        $pid = NULL;
        $stmt->bind_param('iisiiiisss', $pid, $seller, $name, $category, $price, $quantity, $condition, $image_url, $desc, $date_posted);
        $stmt->execute();
        if ($stmt->affected_rows>0) $ok='Product listed successfully.'; else $err='Failed to list product.';
    }
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><title>Sell Item - CampusCarts</title><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="css/style.css"></head>
<body>
<nav class="navbar"><div class="nav-left"><div class="brand">CampusCarts</div></div><div class="nav-links"><a href="home.html">Home</a><a href="products.php">Products</a></div></nav>
<div class="form-card">
  <h2>List an item</h2>
  <?php if($err) echo '<div style="color:#ff6b6b;margin-bottom:10px;">'.htmlspecialchars($err).'</div>'; ?>
  <?php if($ok) echo '<div style="color:#7fffd4;margin-bottom:10px;">'.htmlspecialchars($ok).'</div>'; ?>
  <form method="post" action="sell_item.php">
    <input class="input" name="name" placeholder="Product name" required>
    <input class="input" name="category" placeholder="Category" required>
    <input class="input" name="price" type="number" placeholder="Price (INR)" required>
    <input class="input" name="quantity" type="number" placeholder="Quantity" value="1" required>
    <input class="input" name="condition" placeholder="Condition (New / Used)" required>
    <input class="input" name="image_url" placeholder="Image URL (optional)">
    <textarea class="input" name="description" placeholder="Short description" style="height:100px;"></textarea>
    <button class="btn" type="submit">List Item</button>
  </form>
</div>
</body></html>
