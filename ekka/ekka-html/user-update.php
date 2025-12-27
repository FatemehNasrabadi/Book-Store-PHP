<?php 
session_start();
include('../../config/db.php'); // اتصال به دیتابیس

if(!isset($_SESSION['users_id'])){
    die("دسترسی غیرمجاز");
}

if($_SERVER['REQUEST_METHOD']!=='POST'){
    die("درخواست نامعتبر");
}

$user_id=$_SESSION['users_id'];

$name=mysqli_real_escape_string($conn,$_POST['name']);
$username=mysqli_real_escape_string($conn,$_POST['username']);
$address=mysqli_real_escape_string($conn,$_POST['address']);
$email=mysqli_real_escape_string($conn,$_POST['email']);

$sql="UPDATE users SET 
       name='$name',
       username='$username',
       email='$email',
       address='$address'
       WHERE id=$user_id";

 if(mysqli_query($conn,$sql)){
    header("Location:user-profile.php?success=1");
    exit();
 }else{
    header("Location:user-profile.php?error=1");
    exit();
 }

?>