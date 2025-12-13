<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس


if(!isset($_SESSION['users_id'])){
    header("Location:login.html");
    exit();
}
$user_id=$_SESSION['users_id'];
$product_id=$_GET['id'];

//بررسی وجود محصول در سبد خرید کاربر
$sql="SELECT * FROM carts WHERE user_id=$user_id AND product_id=$product_id ";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    //افزایش تعداد
    mysqli_query($conn,"UPDATE carts SET quantity=quantity+1 WHERE user_id=$user_id AND product_id=$product_id");
}else{
    //افزودن محصول
    mysqli_query($conn,"INSERT INTO carts (user_id, product_id, quantity) VALUE ($user_id, $product_id,1)");
}

header("Location:".$_SERVER['HTTP_REFERER']);
exit();

// //get book id from url
// if(!isset($_GET['id'])|| empty($_GET['id'])){
//     die("invalid product id");
// }
// $product_id=intval($_GET['id']);

// //اگه سبد خرید نبود ایجاد کن
// if(!isset($_SESSION['cart'])){
//     $_SESSION['cart']=[];
// }
// //محصول داخل سبد بود تعداد+1
// if(isset($_SESSION['cart'][$product_id])){
//     $_SESSION['cart'][$product_id]++;
// }else{
//     $_SESSION['cart'][$product_id]=1;
// }
// //برگشت به صقحه قبل
// header("Location:".$_SERVER['HTTP_REFERER']);
// exit();
?>