<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_config.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM students WHERE email='$email' LIMIT 1";
    $res = $conn->query($sql);
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // login success
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['name'] = $row['name'];
            header('Location: products.php');
            exit;
        } else {
            $err = 'Invalid credentials';
        }
    } else {
        $err = 'User not found';
    }
}
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Login - CampusCarts</title><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="css/style.css"></head>
<body>
<nav class="navbar"><div class="nav-left"><div class="brand">CampusCarts</div></div><div class="nav-links"><a href="home.html">Home</a><a href="products.php">Products</a><a href="sell_item.php">Sell</a></div></nav>
<div class="form-card">
  <h2>Login</h2>
  <?php if($err) echo '<div style="color:#ff6b6b;margin-bottom:10px;">'.htmlspecialchars($err).'</div>'; ?>
  <form method="post" action="login.php">
    <input class="input" type="email" name="email" placeholder="College email" required>
    <input class="input" type="password" name="password" placeholder="Password" required>
    <button class="btn" type="submit">Login</button>
  </form>
  <p style="margin-top:10px;color:var(--muted);">Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body></html>
