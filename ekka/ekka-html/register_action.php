<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

include('../../config/db.php'); // اتصال به دیتابیس

// بررسی اینکه فرم ارسال شده
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // دریافت داده‌ها از فرم و جلوگیری از تزریق SQL
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city=mysqli_real_escape_string($conn,$_POST['city']);
    $postal_code=mysqli_real_escape_string($conn,$_POST['postal_code']);


    // هش کردن رمز عبور قبل از ذخیره
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // آماده کردن کوئری برای ذخیره اطلاعات در جدول sellers
    $sql = "INSERT INTO users (name, username, password, mobile_number, email, address, postal_code, city, created_at) 
            VALUES ('$name', '$username', '$password_hashed', '$mobile_number', '$email','$address','$postal_code', '$city', NOW())";

    // اجرای کوئری و بررسی نتیجه
    if (mysqli_query($conn, $sql)) {
        // موفقیت در ثبت‌نام
        echo "ثبت‌نام با موفقیت انجام شد!";
        // انتقال به صفحه ورود بعد از ۲ ثانیه
        header("refresh:2; url=login.html");
    } else {
        // در صورت خطا
        echo "خطا در ثبت‌نام: " . mysqli_error($conn);
    }

    // بستن اتصال به دیتابیس
    mysqli_close($conn);
} else {
    // اگر کاربر مستقیم وارد این صفحه شد
    echo "فرم ثبت‌نام ارسال نشده است.";
}

?>
