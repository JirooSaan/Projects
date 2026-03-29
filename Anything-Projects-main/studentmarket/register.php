<?php
session_start();
require 'db_config.php';
$err = '';
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $branch = $conn->real_escape_string($_POST['branch']);
    $college = $conn->real_escape_string($_POST['college']);
    $password = $_POST['password'];
    // check duplicate
    $check = $conn->query("SELECT * FROM students WHERE email='$email'")->num_rows;
    if ($check > 0) {
        $err = 'Email already registered';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO students (student_id, name, email, college, branch, year, password, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
        // student_id set to NULL for AUTO_INCREMENT compatibility if table uses it; here we use supplied id as NULL
        $student_id = NULL;
        $year = '3rd Year';
        $stmt->bind_param('issssiss', $student_id, $name, $email, $college, $branch, $year, $hash, $phone);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $ok = 'Registration successful. Please login.';
        } else {
            $err = 'Registration failed: ' . $stmt->error;

        }
    }
}
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Register - CampusCarts</title><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="css/style.css"></head>
<body>
<nav class="navbar"><div class="nav-left"><div class="brand">CampusCarts</div></div><div class="nav-links"><a href="home.html">Home</a><a href="products.php">Products</a></div></nav>
<div class="form-card">
  <h2>Create account</h2>
  <?php if($err) echo '<div style="color:#ff6b6b;margin-bottom:10px;">'.htmlspecialchars($err).'</div>'; ?>
  <?php if($ok) echo '<div style="color:#7fffd4;margin-bottom:10px;">'.htmlspecialchars($ok).'</div>'; ?>
  <form method="post" action="register.php">
    <input class="input" type="text" name="name" placeholder="Full name" required>
    <input class="input" type="email" name="email" placeholder="College email" required>
    <input class="input" type="text" name="phone" placeholder="Phone number" required>
    <input class="input" type="text" name="branch" placeholder="Branch (e.g., ECE)" required>
    <input class="input" type="text" name="college" placeholder="College name" value="Goa Engineering College" required>
    <input class="input" type="password" name="password" placeholder="Password" required>
    <button class="btn" type="submit">Register</button>
  </form>
  <p style="margin-top:10px;color:var(--muted);">Already registered? <a href="login.php">Login here</a></p>
</div>
</body></html>
