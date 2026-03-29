
Student Marketplace - Updated Dark Theme (PHP + MySQL)
Files included:
- home.html
- login.php
- register.php
- products.php
- sell_item.php
- db_config.php
- css/style.css
- images/ (placeholder assets)

Setup instructions:
1. Copy this folder into your XAMPP htdocs (or similar web root).
2. Import the 'student_marketplace_full.sql' we generated earlier into phpMyAdmin (creates DB and tables).
3. Ensure db_config.php matches your MySQL credentials (default: root with no password).
4. Start Apache + MySQL in XAMPP and open http://localhost/updated_student_marketplace/home.html
5. Use Register to create an account (passwords are stored hashed using password_hash).
6. Login will redirect to products.php on success. After login, you can list items via Sell page.
Notes:
- All code uses plain PHP mysqli and prepared statements where inserting data.
- This is a simplified demo; in production, add CSRF protection, input validation, and stronger session handling.
