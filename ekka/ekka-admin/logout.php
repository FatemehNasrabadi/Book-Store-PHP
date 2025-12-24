<?php
session_start();

//حذف سشن فروشنده
unset($_SESSION['sellers_id']);
header("Location:sign-in.html");
exit();



?>