<?php
session_start();
require 'db_config.php';
// fetch products
$res = $conn->query("SELECT p.*, s.name as seller_name FROM products p LEFT JOIN students s ON p.seller_id = s.student_id ORDER BY date_posted DESC LIMIT 60");
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Products - CampusCarts</title><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="css/style.css"></head>
<body>
<nav class="navbar"><div class="nav-left"><div class="brand">CampusCarts</div></div><div class="nav-links"><a href="home.html">Home</a><a href="sell_item.php">Sell</a><?php if(isset($_SESSION['name'])) echo '<a href="#">Hi '.htmlspecialchars($_SESSION['name']).'</a>'; else echo '<a href="login.php">Login</a>'; ?></div></nav>

<section class="grid">
<?php while($row = $res->fetch_assoc()): ?>
    <div class="card" style="background-image: url('<?php echo htmlspecialchars($row['image_url'] ?: 'https://via.placeholder.com/480x320?text=No+Image'); ?>'); background-size: cover; background-position: center;">
    <div class="overlay">
      <div class="title"><?php echo htmlspecialchars($row['name']); ?></div>
      <div class="meta">Seller: <?php echo htmlspecialchars($row['seller_name'] ?: 'Unknown'); ?> • <?php echo htmlspecialchars($row['condition']); ?></div>
      <div class="price">₹<?php echo number_format($row['price']); ?></div>
    </div>
  </div>

<?php endwhile; ?>
</section>

<footer>&copy; 2025 Student Marketplace. Created By OreoMaggi</footer>
</body></html>
