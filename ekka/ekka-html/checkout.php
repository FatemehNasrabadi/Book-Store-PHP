<?php

session_start();
include('../../config/db.php'); // اتصال به دیتابیس


if (!isset($_SESSION['users_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users_id'];

// گرفتن سبد خرید کاربر
$sql = "SELECT c.product_id, c.quantity, b.price, b.seller_id
        FROM carts c
        JOIN books b ON c.product_id = b.id
        WHERE c.user_id = $user_id";

$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) == 0){
    die("سبد خرید شما خالی است.");
}

// ثبت سفارش در جدول orders و کم کردن موجودی
while($row = mysqli_fetch_assoc($res)){
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $seller_id = $row['seller_id'];

    // ثبت سفارش
    mysqli_query($conn, "INSERT INTO orders (user_id, product_id, seller_id, quantity, price, order_time) 
                         VALUES ($user_id, $product_id, $seller_id, $quantity, $price, NOW())");

    // کم کردن موجودی محصول
    mysqli_query($conn, "UPDATE books SET quantity = quantity - $quantity WHERE id = $product_id");
}

// خالی کردن سبد خرید کاربر
mysqli_query($conn, "DELETE FROM carts WHERE user_id = $user_id");

echo "سفارش شما با موفقیت ثبت شد!";

?>

