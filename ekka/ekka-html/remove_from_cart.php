<?php
session_start();
include('../../config/db.php');

if(!isset($_SESSION['users_id'])){
    header("Location: login.html");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['users_id'];
$product_id = (int) $_GET['id'];

// حذف محصول از سبد خرید کاربر
$sql = "DELETE FROM carts 
        WHERE user_id = $user_id 
        AND product_id = $product_id";

mysqli_query($conn, $sql);

// برگشت به سبد خرید
header("Location: cart.php");
exit();