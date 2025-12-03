<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس
//get book id from url

if(!isset($_GET['id'])|| empty($_GET['id'])){
    die("invalid product id");
}
$product_id=intval($_GET['id']);

//اگه سبد خرید نبود ایجاد کن
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}
//محصول داخل سبد بود تعداد+1
if(isset($_SESSION['cart'][$product_id])){
    $_SESSION['cart'][$product_id]++;
}else{
    $_SESSION['cart'][$product_id]=1;
}
//برگشت به صقحه قبل
header("Location:".$_SERVER['HTTP_REFERER']);
exit();
?>