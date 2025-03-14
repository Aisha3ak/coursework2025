# 🛒 PHP MySQL Marketplace  

This is an **online marketplace platform** built using **PHP and MySQL**, where users can **buy and sell products** with ease. The project demonstrates the use of **PHP for server-side scripting** and **MySQL for database management**.  

![🛍 Marketplace Banner](./src/images/banner.png?raw=true)  

---

## 🎯 **Features**  

✅ **🔐 User Registration & Login** – Users can create accounts, log in, and manage their profiles  
✅ **🛍 Product Listings** – Sellers can list products with price, description, and images  
✅ **🔎 Search & Filters** – Users can search for products and filter them based on various criteria  
✅ **🛒 Shopping Cart** – Users can add products to their cart and proceed to checkout  
✅ **📦 Order Management** – Admins can manage orders and update order statuses  
✅ **🔒 Enhanced Security** – Protection against SQL injection and XSS attacks

---

## 🔑 **Login Page**  

![🔑 Login Roles](./src/images/roles.png?raw=true)  

- **🖥 Admin Login:** `iqbolshoh`  
- **👤 Seller Login:** `user`  
- **👤 User Login:** `user`  
- **🔑 Password:** `IQBOLSHOH`  

---

## 👥 **User Roles**  

### 🏆 **Admin**  
![⚙ Admin Panel](./src/images/admin.png?raw=true)  
- 🔹 Manages the entire marketplace  
- 🔹 Can view and manage all users and their products  
- 🔹 Can update or delete any listings  
- 🔹 Oversees order management and resolves issues  
- 🔹 Can **block** users if needed  

### 🛒 **Seller**  
![🛍 Seller Panel](./src/images/seller.png?raw=true)  
- 🔹 Can **list** products for sale and manage their listings  
- 🔹 Can view and update their **orders**  
- 🔹 Manages their **profile and product details**  

### 👤 **User (Customer)**  
![🛍 User Panel](./src/images/user.png?raw=true)  
- 🔹 Can **browse products**, add them to the cart, and **purchase**  
- 🔹 Can create and manage their **profile**  
- 🔹 Can view **order history** and track orders  

---

## 🔒 **Security Improvements**

This marketplace application has been enhanced with several security improvements:

### 1. SQL Injection Protection
- Implemented prepared statements for all database queries
- Parameterized queries in authentication and data retrieval functions
- Removed direct string concatenation in SQL queries

### 2. Cross-Site Scripting (XSS) Prevention
- Added proper output encoding for all user-generated content
- Implemented `htmlspecialchars()` with ENT_QUOTES flag for comprehensive protection
- Secured error messages and notifications

### 3. Input Validation
- Comprehensive server-side validation for all user inputs
- Client-side validation to enhance user experience
- Type checking and sanitization of data

---

## ⚡ **Installation Guide**  

To set up the **PHP-MySQL Marketplace**, follow these steps:  

### 1️⃣ **Clone the Repository**  
```bash
git clone https://github.com/Iqbolshoh/php-mysql-marketplace.git
```

### 2️⃣ **Navigate to the Project Directory**  
```bash
cd php-mysql-marketplace
```

### 3️⃣ **Set Up the Database**  
- **Create a new MySQL database**:  
  ```sql
  CREATE DATABASE marketplace;
  ```
- **Import the database schema**:  
  ```bash
  mysql -u yourusername -p marketplace < database.sql
  ```

### 4️⃣ **Configure Database Connection**  
- Open the **`config.php`** file in the root directory  
- Update the database credentials:  
  ```php
  <?php

  public function __construct() {
      $servername = "localhost";
      $username = "your_username";
      $password = "password";
      $dbname = "marketplace";

      $this->conn = new mysqli($servername, $username, $password, $dbname);

      if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
      }
  }
  ```
- **Ensure you have a `Database` class** in the `config.php` file  

### 5️⃣ **Set Up Web Server Environment**
- **XAMPP/WAMP/MAMP**: 
  - Install one of these local server packages
  - Move the project folder to the `htdocs` (XAMPP/MAMP) or `www` (WAMP) directory

- **Apache Configuration**:
  - Ensure PHP module is enabled
  - Set proper permissions for file uploads:
    ```bash
    chmod 755 -R /path/to/src/images/products
    ```

### 6️⃣ **Run the Application**  
- Start your local web server (Apache)
- Open your browser and access:  
  ```
  http://localhost/php-mysql-marketplace
  ```

### 7️⃣ **Security Best Practices**
- Regularly update your PHP installation
- Keep MySQL/MariaDB updated to the latest version
- Consider using HTTPS even in local development
- Review server logs regularly for suspicious activity

---

## 🖥 Technologies Used
<div style="display: flex; flex-wrap: wrap; gap: 5px;">
    <img src="https://img.shields.io/badge/HTML-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white" alt="HTML">
    <img src="https://img.shields.io/badge/CSS-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white" alt="CSS">
    <img src="https://img.shields.io/badge/Bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
    <img src="https://img.shields.io/badge/JavaScript-%23F7DF1C.svg?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
    <img src="https://img.shields.io/badge/jQuery-%230e76a8.svg?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery">
    <img src="https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-%234479A1.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</div>

