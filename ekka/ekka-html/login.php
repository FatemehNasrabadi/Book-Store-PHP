<?php

session_start();
include('../../config/db.php'); // اتصال به دیتابیس


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){
            
            $_SESSION['users_id'] = $user['id'];//   را در سشن ذخیره کن id
            $_SESSION['username'] = $user['name'];  //  اسم کاربر را در سشن ذخیره کن

            header("Location: index.php");
            exit();

        } else {
            echo "رمز عبور اشتباه است";
        }
    } else {
        echo "نام کاربری یافت نشد";
    }
}



?>