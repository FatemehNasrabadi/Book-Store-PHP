<?php
//اتصال به دیتابیس
include'config/db.php';
$result=mysqli_query($conn,"SELECT*FROM books LIMIT 1");
if($result){
    echo"succsee";
}

?>