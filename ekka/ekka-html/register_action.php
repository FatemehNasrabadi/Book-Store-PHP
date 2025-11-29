<?php
include('../../config/db.php'); // اتصال به دیتابیس

//چک خالی نبودن
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //گرفتن داده و امن سازی
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $mobile_number=mysqli_real_escape_string($conn,$_POST['mobile_number']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $postal_code=mysqli_real_escape_string($conn,$_POST['postal_code']);
    $city=mysqli_real_escape_string($conn,$_POST['city']);
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT); //هش رمز

    //چک تکراری نبودن ایمیل و نام کاربری
    $check="SELECT id FROM users WHERE email='$email' OR username='$username'";
    $rescheck=mysqli_query($conn,$check);
    
    if(mysqli_num_rows($rescheck)>0){
        echo "ایمیل یا نام کاربری قبلا ثبت شده است";
        exit();
    }

    //ذخیره در دیتابیس
    $sql="INSERT INTO users (name, username, email,mobile_number, address, city, password, postal_code, created_at)
    VALUE ('$name','$username','$email','$mobile_number','$address','$city','$password', '$postal_code', NOW())";

    if(mysqli_query($conn,$sql)){
        echo"success";
    }else{
        echo "خطا". mysqli_error($conn);
    }

}
?>