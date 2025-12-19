-- Create database
CREATE DATABASE IF NOT EXISTS foodorder;
USE foodorder;

-- Admin table
CREATE TABLE tbl_admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100),
  username VARCHAR(50),
  password VARCHAR(255)
);

INSERT INTO tbl_admin (full_name, username, password)
VALUES ('Admin User', 'admin', 'admin');

-- Category table
CREATE TABLE tbl_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  image_name VARCHAR(255),
  featured VARCHAR(10),
  active VARCHAR(10)
);

-- Food table
CREATE TABLE tbl_food (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  price DECIMAL(10,2),
  image_name VARCHAR(255),
  category_id INT,
  featured VARCHAR(10),
  active VARCHAR(10)
);

-- Order table
CREATE TABLE tbl_order (
  id INT AUTO_INCREMENT PRIMARY KEY,
  food VARCHAR(150),
  price DECIMAL(10,2),
  qty INT,
  total DECIMAL(10,2),
  order_date DATETIME,
  status VARCHAR(50),
  customer_name VARCHAR(100),
  customer_contact VARCHAR(50),
  customer_email VARCHAR(100),
  customer_address TEXT
);

