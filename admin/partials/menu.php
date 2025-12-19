<?php
include('../config/constants.php');
include('login-check.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Order Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="<?php echo SITEURL; ?>admin/index.php">Home</a></li>
            <li><a href="<?php echo SITEURL; ?>admin/manage-category.php">Category</a></li>
            <li><a href="<?php echo SITEURL; ?>admin/manage-food.php">Food</a></li>
            <li><a href="<?php echo SITEURL; ?>admin/manage-order.php">Order</a></li>
            <li><a href="<?php echo SITEURL; ?>admin/logout.php">Logout</a></li>
        </ul>
    </div>
</div>
