<?php
$host="localhost"; //نام سرور
$user="root"; //نام کاربری دیتابیس
$password=""; //رمز دیتابیس
$database="bookstore"; //نام دیتابیس
//اتصال به دیتابیس
$conn= mysqli_connect($host, $user, $password,$database);
//بررسی اتصال
// if(!$conn){
//     die("Connection failed:" . mysqli_connect_error());
//     }else{
//     echo"true";

// }
?>
