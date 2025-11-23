<?php
include('../../config/db.php'); // اتصال به دیتابیس



// بررسی اینکه فرم ارسال شده باشد
if(isset($_POST['submit'])){

    // گرفتن مقادیر فرم و امن کردن آن‌ها برای جلوگیری از SQL Injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);

    // مسیر ذخیره عکس
    $target_dir = "../ekka-html/assets/images/products/";
    $image_name = basename($_FILES["image"]["name"]); // اسم فایل آپلود شده
    $target_file = $target_dir . $image_name; // مسیر نهایی فایل

    // آپلود عکس
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){

        // آماده کردن دستور INSERT برای ذخیره اطلاعات در دیتابیس
        $sql = "INSERT INTO books 
        (name, price, quantity, description, discount, sold_count, status, created_at, image, category) 
        VALUES 
        ('$name', '$price', '$quantity', '$description', '$discount', 0, '$status', NOW(), '$image_name','$category')";

        // اجرای دستور INSERT
        if(mysqli_query($conn, $sql)){
            // نمایش پیام موفقیت در صفحه
            echo '<div style="text-align:center; margin-top:50px;">
                    <h2>کتاب با موفقیت اضافه شد!</h2>
                    <p>در حال انتقال به صفحه محصولات...</p>
                  </div>';

            // بعد از 2 ثانیه هدایت به صفحه product-list.php
            echo '<meta http-equiv="refresh" content="2;url=product-list.php">';

            // متوقف کردن اجرای باقی کدها
            exit;

        } else {
            // در صورت بروز خطا هنگام ذخیره اطلاعات در دیتابیس
            echo "خطا در ذخیره: " . mysqli_error($conn);
        }

    } else {
        // در صورت بروز خطا هنگام آپلود عکس
        echo "خطا در آپلود تصویر";
    }
}
// اگر فرم submit نشده باشد، هیچ کاری انجام نمی‌شود
?>


<form class="ec-add-product-form" action="product-add.php" method="POST" enctype="multipart/form-data">;
