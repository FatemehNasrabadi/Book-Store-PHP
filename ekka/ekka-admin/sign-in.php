<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // بررسی کاربر در جدول
    $sql = "SELECT * FROM sellers WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        // بررسی رمز عبور
        if(password_verify($password, $user['password'])){
            session_start(); 
            $_SESSION['sellers_id'] = $user['id'];//نذخیره ای دی فروشنده در سش
            // ریدایرکت به صفحه داشبورد
            header("Location: index.html");
            exit();
        } else {
            echo "رمز عبور اشتباه است";
        }
    } else {
        echo "نام کاربری یافت نشد";
    }
}

?>






