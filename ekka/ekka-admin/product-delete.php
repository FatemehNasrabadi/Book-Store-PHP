<?php
// product-delete.php

include('../../config/db.php'); // اتصال به دیتابیس


// 2. گرفتن id محصول از URL
// اگر id ارسال نشده بود، کاربر به صفحه محصولات هدایت می‌شود
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: product-list.php");
    exit;
}

$id = (int) $_GET['id']; // گرفتن id و تبدیل به عدد برای امنیت

// 3. حذف محصول از جدول books
$sql = "DELETE FROM books WHERE id = $id";
if(mysqli_query($conn, $sql)){
    // 4. بعد از حذف، به صفحه محصولات برگرد
    header("Location: product-list.php");
    exit;
} else {
    echo "خطا در حذف محصول: " . mysqli_error($conn);
}
?>