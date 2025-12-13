<?php

ob_start();

session_start();
include('../../config/db.php'); // اتصال به دیتابیس

//  بررسی ورود کاربر ----------
if (!isset($_SESSION['users_id'])) {
    // اگر می‌خواهی به صفحه لاگین برود به جای die از header استفاده کن
    die("لطفا وارد حساب شوید.");
}
$user_id = intval($_SESSION['users_id']); // امنیت: تبدیل به عدد

//  گرفتن آیتم‌های سبد خرید از جدول carts ----------
$cart_sql = "
SELECT c.product_id, c.quantity, b.price
FROM carts c
JOIN books b ON c.product_id = b.id
WHERE c.user_id = $user_id
";
$cart_result = mysqli_query($conn, $cart_sql);

// بررسی خطای کوئری
if ($cart_result === false) {
    die("خطا در خواندن سبد خرید: " . mysqli_error($conn));
}

if (mysqli_num_rows($cart_result) == 0) {
    die("سبد خرید خالی است");
}

//  شروع تراکنش برای اطمینان از اتمیک بودن عملیات ----------
mysqli_begin_transaction($conn);

try {
    // آماده‌سازی statement برای INSERT در orders (امن‌تر)
    $insert_stmt = mysqli_prepare($conn, "
        INSERT INTO orders (user_id, product_id, seller_id, quantity, price, order_time)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    if (!$insert_stmt) {
        throw new Exception("خطا در آماده‌سازی دستور INSERT: " . mysqli_error($conn));
    }

    // آماده‌سازی statement برای UPDATE sold_count در books
    $update_stmt = mysqli_prepare($conn, "
        UPDATE books SET sold_count = sold_count + ? WHERE id = ?
    ");
    if (!$update_stmt) {
        throw new Exception("خطا در آماده‌سازی دستور UPDATE: " . mysqli_error($conn));
    }

    // حلقه روی آیتم‌های سبد خرید
    while ($row = mysqli_fetch_assoc($cart_result)) {
        $product_id = intval($row['product_id']);
        $seller_id  = intval($row['seller_id']);
        $quantity   = intval($row['quantity']);
        $price      = floatval($row['price']); // قیمت واحد

        // اجرای INSERT (پارامترها: user_id, product_id, seller_id, quantity, price)
        mysqli_stmt_bind_param($insert_stmt, "iiiid", $user_id, $product_id, $seller_id, $quantity, $price);
        if (!mysqli_stmt_execute($insert_stmt)) {
            throw new Exception("خطا در ثبت سفارش برای محصول $product_id: " . mysqli_stmt_error($insert_stmt));
        }

        // بروزرسانی sold_count
        mysqli_stmt_bind_param($update_stmt, "ii", $quantity, $product_id);
        if (!mysqli_stmt_execute($update_stmt)) {
            throw new Exception("خطا در بروزرسانی sold_count برای محصول $product_id: " . mysqli_stmt_error($update_stmt));
        }
    }

    // اگر همه‌ی INSERT و UPDATEها موفق بودند: حذف رکوردهای cart
    $delete_sql = "DELETE FROM carts WHERE user_id = $user_id";
    if (!mysqli_query($conn, $delete_sql)) {
        throw new Exception("خطا در حذف سبد خرید از جدول carts: " . mysqli_error($conn));
    }

    // پاک کردن سشن‌های محلی سبد (اگر از سشن هم استفاده می‌کنی)
    if (isset($_SESSION['cart'])) {
        // اگر سبد در ساختار $_SESSION['cart'][$user_id] نگهداری می‌شد، آن را هم پاک کن
        if (isset($_SESSION['cart'][$user_id])) {
            unset($_SESSION['cart'][$user_id]);
        } else {
            // یا اگر سبد ساده در $_SESSION['cart'] بود:
            unset($_SESSION['cart']);
        }
    }

    // همه چی اوکی: کامیت تراکنش
    mysqli_commit($conn);

    // آزاد کردن statementها
    mysqli_stmt_close($insert_stmt);
    mysqli_stmt_close($update_stmt);

    // ریدایرکت به صفحه تاریخچه سفارش
    header("Location: user-history.php");
    exit();

} catch (Exception $e) {
    // اگر هر خطایی رخ داد: rollback و نمایش خطای مناسب (در محیط تولید بهتر لاگ کن)
    mysqli_rollback($conn);
    // برای دیباگ در محیط توسعه:
    die("خطا در فرایند پرداخت: " . $e->getMessage());
}

// اطمینان از flush خروجی بافر
ob_end_flush();

?>
