<?php

session_start();
include('../../config/db.php'); // اتصال به دیتابیس

// اگر کاربر لاگین نیست
if (!isset($_SESSION['users_id'])) {
    die("لطفا وارد حساب شوید.");
}

$user_id = $_SESSION['user_id'];

// اگر سبد خرید خالی است
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    die("سبد خرید خالی است.");
}

// ذخیره هر محصول در جدول orders
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    mysqli_query($conn,
         "INSERT INTO orders (user_id, product_id, quantity, order_time)
         VALUE ($user_id,$product_id,$quantity,NOW())");

    // // گرفتن قیمت محصول
    // $sql = "SELECT price FROM books WHERE id = $product_id";
    // $res = mysqli_query($conn, $sql);
    // $p = mysqli_fetch_assoc($res);

    // $total = $p['price'] * $qty;

    // mysqli_query($conn,
    //     "INSERT INTO orders (user_id, product_id, quantity, price)
    //      VALUES ($user_id, $product_id, $qty, $total)"
    // );
}

// پس از ثبت خرید → سبد را خالی کن
unset($_SESSION['cart']);

header("Location: user-history.php?success=1");
exit;

?>