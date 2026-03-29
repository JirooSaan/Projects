DROP DATABASE IF EXISTS student_marketplace;
CREATE DATABASE student_marketplace;
USE student_marketplace;

-- ---------------------------
-- STUDENTS TABLE
-- ---------------------------
CREATE TABLE students (
  student_id INT PRIMARY KEY,
  name VARCHAR(200),
  email VARCHAR(200),
  college VARCHAR(200),
  branch VARCHAR(100),
  year VARCHAR(50),
  password VARCHAR(200),
  phone VARCHAR(30)
);

-- ---------------------------
-- PRODUCTS TABLE
-- ---------------------------
CREATE TABLE products (
  product_id INT PRIMARY KEY AUTO_INCREMENT,
  seller_id INT NULL,
  name VARCHAR(300),
  category VARCHAR(100),
  price INT,
  quantity INT,
  `condition` VARCHAR(50),
  image_url VARCHAR(500),
  description TEXT,
  date_posted DATE,
  FOREIGN KEY (seller_id) REFERENCES students(student_id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

-- ---------------------------
-- ORDERS TABLE
-- ---------------------------
CREATE TABLE orders (
  order_id INT PRIMARY KEY AUTO_INCREMENT,
  buyer_id INT,
  seller_id INT,
  product_id INT,
  quantity INT,
  total_price INT,
  order_date DATE,
  status VARCHAR(50),
  FOREIGN KEY (buyer_id) REFERENCES students(student_id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (seller_id) REFERENCES students(student_id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- ---------------------------
-- INSERT STUDENTS
-- ---------------------------
INSERT INTO students VALUES 
(1,'Aarav Naik','aarav.naik@studentmail.com','St. Xavier''s College','ECE','3rd Year','pass123','9859447379'),
(2,'Vihaan Patel','vihaan.patel@studentmail.com','Government Polytechnic Mayem','Civil','4th Year','pass123','9831701372'),
(3,'Arjun Shah','arjun.shah@studentmail.com','NIT Goa','CSE','4th Year','pass123','9845042906'),
(4,'Dhruv Singh','dhruv.singh@studentmail.com','Modern Engineering College','IT','2nd Year','pass123','9857634057'),
(5,'Rohan Kumar','rohan.kumar@studentmail.com','Goa Engineering College','Instrumentation','2nd Year','pass123','9829883842'),
(6,'Ishaan Reddy','ishaan.reddy@studentmail.com','Government Polytechnic Mayem','CSE','2nd Year','pass123','9855843464'),
(7,'Kabir Nair','kabir.nair@studentmail.com','NIT Goa','ECE','4th Year','pass123','9855569304'),
(8,'Aditya Iyer','aditya.iyer@studentmail.com','Goa Engineering College','Instrumentation','1st Year','pass123','9810895675'),
(9,'Krishna Desai','krishna.desai@studentmail.com','Government Polytechnic Mayem','IT','3rd Year','pass123','9823354614'),
(10,'Karan Joshi','karan.joshi@studentmail.com','St. Xavier''s College','CSE','2nd Year','pass123','9860331967'),
(11,'Aisha Gomes','aisha.gomes@studentmail.com','Government Polytechnic Mayem','EEE','1st Year','pass123','9841179867'),
(12,'Sana Fernandes','sana.fernandes@studentmail.com','Goa Engineering College','Applied Mechanics','2nd Year','pass123','9884502287'),
(13,'Ananya DSouza','ananya.dsouza@studentmail.com','Government Polytechnic Mayem','Civil','4th Year','pass123','9879556912'),
(14,'Meera Menon','meera.menon@studentmail.com','Government Polytechnic Mayem','ECE','2nd Year','pass123','9850443382'),
(15,'Ira Acharya','ira.acharya@studentmail.com','Goa Engineering College','IT','2nd Year','pass123','9856939607'),
(16,'Rhea Borkar','rhea.borkar@studentmail.com','Modern Engineering College','EEE','2nd Year','pass123','9861809794'),
(17,'Nisha More','nisha.more@studentmail.com','NIT Goa','ECE','1st Year','pass123','9818172510'),
(18,'Priya Khot','priya.khot@studentmail.com','St. Xavier''s College','CSE','4th Year','pass123','9834090046'),
(19,'Simran Prabhu','simran.prabhu@studentmail.com','Goa Engineering College','EEE','2nd Year','pass123','9878789724'),
(20,'Kavya Shetty','kavya.shetty@studentmail.com','Goa Engineering College','Applied Mechanics','1st Year','pass123','9811854586'),
(21,'Rahul Sharma','rahul.sharma@studentmail.com','St. Xavier''s College','EEE','4th Year','pass123','9883794219'),
(22,'Sameer Verma','sameer.verma@studentmail.com','Government Polytechnic Mayem','EEE','1st Year','pass123','9884700621'),
(23,'Vivek Gupta','vivek.gupta@studentmail.com','Government Polytechnic Mayem','CSE','4th Year','pass123','9832139443'),
(24,'Manav Chaudhary','manav.chaudhary@studentmail.com','NIT Goa','Mechanical','2nd Year','pass123','9831950374'),
(25,'Siddharth Bisht','siddharth.bisht@studentmail.com','Government Polytechnic Mayem','Civil','2nd Year','pass123','9882091097'),
(26,'Tanya Kapoor','tanya.kapoor@studentmail.com','Goa Engineering College','ECE','2nd Year','pass123','9810427478'),
(27,'Neha Jain','neha.jain@studentmail.com','St. Xavier''s College','IT','1st Year','pass123','9845470884'),
(28,'Pooja Chopra','pooja.chopra@studentmail.com','Modern Engineering College','Instrumentation','1st Year','pass123','9871856288'),
(29,'Varun Saxena','varun.saxena@studentmail.com','St. Xavier''s College','IT','2nd Year','pass123','9834739157'),
(30,'Aniket Bhat','aniket.bhat@studentmail.com','Goa Engineering College','EEE','3rd Year','pass123','9833617032');

-- ---------------------------
-- INSERT PRODUCTS
-- ---------------------------
INSERT INTO products (seller_id,name,category,price,quantity,`condition`,image_url,description,date_posted) VALUES
(13,'Data Structures Textbook','Books',1220,5,'New','https://via.placeholder.com/480x320?text=Books+1','Data Structures Textbook - New','2025-02-21'),
(14,'Discrete Mathematics Book','Books',543,3,'Used','https://via.placeholder.com/480x320?text=Books+2','Discrete Math Book','2025-07-02'),
(3,'Microelectronics Book','Books',943,2,'Used','https://via.placeholder.com/480x320?text=Books+3','Microelectronics Book','2024-01-29'),
(20,'Signals and Systems Book','Books',950,2,'Used','https://via.placeholder.com/480x320?text=Books+4','Signals & Systems','2024-05-08'),
(29,'Linear Algebra Book','Books',1030,3,'Like New','https://via.placeholder.com/480x320?text=Books+5','Linear Algebra','2025-06-27'),
(18,'Operating Systems Book','Books',977,1,'Used','https://via.placeholder.com/480x320?text=Books+6','Operating Systems Book','2025-02-09'),
(25,'Network Theory Book','Books',675,5,'Like New','https://via.placeholder.com/480x320?text=Books+7','Network Theory','2024-05-03');
