<?php
include('../../config/db.php'); // اتصال به دیتابیس

// //بررسی ارسال فرم
// if($_SERVER["REQUEST_METHOD"]=="POST"){
//     //دریاقت و امن کردن داده هاپ
//     $username=mysqli_real_escape_string($conn,$_POST['username']);
//      $password=mysqli_real_escape_string($conn,$_POST['password']);
//      //جستجو در جدول sellers براساس نام کاربری
//      $sql="SELECT*FROM sellers WHERE username='$username'";
//      $result=mysqli_query($conn,$sql);
//       if(mysqli_num_rows($result)==1){
//         //کاربر یافت شد
//         $row=mysqli_fetch_assoc($result);
//         //بررسی رمزعبور باهش دخیره شده
//         if(password_verify($password,$row['password'])){
//             //رمز عبور درست
//             $_SESSION['sellers_id']=$row['id'];
//             $_SESSION['sellers_name']=$row['name'];
//             echo "ورود موفق..درحال انتفال به داشبورد";
//             header("refresh:2; url=index.html");
//             exit();
//         }else{
//             //رمز نادرست
//             echo "رمز یا نام کاربری اشتباه است";
//         }

//         }

//       }

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






