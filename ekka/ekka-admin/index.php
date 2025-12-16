<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس

if(!isset($_SESSION['sellers_id'])){
    header("Location: sign-in.html");
    exit();
}
$seller_id=intval($_SESSION['sellers_id']);


//تعداد ثبتنام کاربران
$sql_users="SELECT COUNT(*) AS total_users FROM users";
$res_users=mysqli_query($conn,$sql_users);
$row_users=mysqli_fetch_assoc($res_users);
$total_users=$row_users['total_users'];


//تعداد کل سفارش ها
$sql_orders="SELECT COUNT(*) AS total_orders FROM orders";
$res_orders=mysqli_query($conn,$sql_orders);
$row_orders=mysqli_fetch_assoc($res_orders);
$total_orders=$row_orders['total_orders'];


//تعداد سفارش فروشنده
$sql_orders_seller = "
    SELECT COUNT(*) AS total_seller_orders
    FROM orders
    WHERE seller_id = $seller_id
";

$seller_order = mysqli_query($conn, $sql_orders_seller);
if (!$seller_order) {
    die("خطا در اجرای کوئری سفارش‌ها: " . mysqli_error($conn));
}
$row_seller_order = mysqli_fetch_assoc($seller_order);
$total_seller_orders = $row_seller_order['total_seller_orders'] ?? 0;


//درامد کل فروشنده
$sql_income="
SELECT SUM(price) AS total_income
FROM orders
WHERE seller_id=$seller_id";
$res_income=mysqli_query($conn,$sql_income);
if(!$res_income){
    die("خطا در اجرای کوئری".mysqli_error($conn));
}
$row_income=mysqli_fetch_assoc($res_income);
$total_income=isset($row_income['total_income'])? $row_income['total_income']:0;



/* فروش سالانه نمودار*/
// ایجاد آرایه‌ای برای ماه‌های شمسی با مقدار اولیه صفر
$months = ['فروردین'=>0,'اردیبهشت'=>0,'خرداد'=>0,'تیر'=>0,'مرداد'=>0,'شهریور'=>0,'مهر'=>0,'آبان'=>0,'آذر'=>0,'دی'=>0,'بهمن'=>0,'اسفند'=>0];

// کوئری گرفتن مجموع فروش هر ماه از جدول orders برای فروشنده
$sql_yearly = "
    SELECT MONTH(order_time) AS month, SUM(price * quantity) AS total
    FROM orders
    WHERE seller_id = $seller_id AND YEAR(order_time) = YEAR(CURDATE())
    GROUP BY MONTH(order_time)
";

$res_yearly = mysqli_query($conn, $sql_yearly);
if(!$res_yearly) {
    die("خطا در دریافت داده‌های نمودار: " . mysqli_error($conn));
}

// پر کردن آرایه ماه‌ها با مقدار واقعی
while($row = mysqli_fetch_assoc($res_yearly)){
    $month_index = (int)$row['month'] - 1; // MONTH() عدد 1 تا 12 میده
    $months[array_keys($months)[$month_index]] = (float)$row['total'];
}

// آماده کردن آرایه‌ها برای جاوااسکریپت
$labels = json_encode(array_keys($months));
$data = json_encode(array_values($months));


//لیست سقارشات اخیر
// گرفتن آخرین 10 سفارش فروشنده
$sql_recent_orders = "
SELECT o.id AS order_id, o.quantity, o.price, o.order_time, b.name AS product_name, b.image AS product_image
FROM orders o
JOIN books b ON o.product_id = b.id
WHERE o.seller_id = $seller_id
ORDER BY o.order_time DESC
LIMIT 10
";

$result_recent_orders = mysqli_query($conn, $sql_recent_orders);
if(!$result_recent_orders){
    die("خطا در اجرای کوئری سفارشات اخیر: " . mysqli_error($conn));
}


//لیست مشتریان اخیر
$sql_new_users="
SELECT 
 u.id, u.name, u.username, 
 COUNT(o.id) AS total_orders,
 COALESCE(SUM(o.price*o.quantity), 0) AS total_spent
 FROM users u
 LEFT JOIN orders o ON u.id=o.user_id 
 GROUP BY u.id
 ORDER BY u.created_at DESC LIMIT 5";
 $res_new_users=mysqli_query($conn,$sql_new_users);
 if(!$res_new_users){
    die("خطا در دریافت مشتریان جدید:".mysqli_error($conn));
 }


 //لیست پرفروش ترین 
$sql_top_product="
SELECT id,name,price,category,image,sold_count
FROM books
WHERE sold_count>0
AND status='actives'
ORDER BY sold_count DESC LIMIT 5";
$res_top_product=mysqli_query($conn,$sql_top_product);
if(!$res_top_product){
    die('خطا:'.mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="اکا - داشبرد مدیریتی فروشگاهی اچ تی ام ال">
    <title>اکا - داشبرد مدیریتی فروشگاهی اچ تی ام ال.</title>
      
     
    <link href="assets/css/materialdesignicons.min.css" rel="stylesheet">    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet">
    <link id="ekka-css" href="assets/css/ekka.css" rel="stylesheet">
    <link href="assets/img/favicon.png" rel="shortcut icon">
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">
    <div class="wrapper">
        <div class="ec-left-sidebar ec-bg-sidebar">
            <div id="sidebar" class="sidebar ec-sidebar-footer">
                <div class="ec-brand"><a href="index.html" title="Ekka"><img class="ec-brand-icon" src="assets/img/logo/ec-site-logo.png" alt=""> <span class="ec-brand-name text-truncate">اکا </span></a></div>
                <div class="ec-navigation" data-simplebar="">
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="active"><a class="sidenav-item-link" href="index.html"><i class="mdi mdi-view-dashboard-outline"></i> <span class="nav-text">داشبرد</span></a>
                            <hr>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-account-group-outline"></i> <span class="nav-text">فروشندگان</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="vendor-card.html"><span class="nav-text">گرید فروشندگان</span></a></li>
                                    <li><a class="sidenav-item-link" href="vendor-list.html"><span class="nav-text">لیست فروشندگان</span></a></li>
                                    <li><a class="sidenav-item-link" href="vendor-profile.html"><span class="nav-text">پروفایل فروشنده</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-account-group"></i> <span class="nav-text">کاربران</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="user-card.html"><span class="nav-text">گرید کاربران</span></a></li>
                                    <li><a class="sidenav-item-link" href="user-list.html"><span class="nav-text">لیست کاربران</span></a></li>
                                    <li><a class="sidenav-item-link" href="user-profile.html"><span class="nav-text">پروفایل کاربر</span></a></li>
                                </ul>
                            </div>
                            <hr>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-dns-outline"></i> <span class="nav-text">دسته‌بندی‌ها</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="main-category.html"><span class="nav-text">دسته‌بندی‌ اصلی</span></a></li>
                                    <li><a class="sidenav-item-link" href="sub-category.html"><span class="nav-text">دسته‌بندی‌ فرعی</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-palette-advanced"></i> <span class="nav-text">محصولات</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="product-add.html"><span class="nav-text">افزودن محصول</span></a></li>
                                    <li><a class="sidenav-item-link" href="product-list.html"><span class="nav-text">لیست محصولات</span></a></li>
                                    <li><a class="sidenav-item-link" href="product-grid.html"><span class="nav-text">گرید محصولات</span></a></li>
                                    <li><a class="sidenav-item-link" href="product-detail.html"><span class="nav-text">جزییات محصول</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-cart"></i> <span class="nav-text">سفارشات</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="new-order.html"><span class="nav-text">سفارش جدید</span></a></li>
                                    <li><a class="sidenav-item-link" href="order-history.html"><span class="nav-text">گزارش سفارش </span></a></li>
                                    <li><a class="sidenav-item-link" href="order-detail.html"><span class="nav-text">جزییات سفارش </span></a></li>
                                    <li><a class="sidenav-item-link" href="invoice.html"><span class="nav-text">فاکتور </span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="sidenav-item-link" href="review-list.html"><i class="mdi mdi-star-half"></i> <span class="nav-text">نظرات</span></a></li>
                        <li><a class="sidenav-item-link" href="brand-list.html"><i class="mdi mdi-tag-faces"></i> <span class="nav-text">برند ها</span></a>
                            <hr>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-login"></i> <span class="nav-text">احراز هویت</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="authentication" data-parent="#sidebar-menu">
                                    <li><a href="sign-in.html"><span class="nav-text">ورود</span></a></li>
                                    <li><a href="sign-up.html"><span class="nav-text">ثبت نام</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-diamond-stone"></i> <span class="nav-text">آیکون ها</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="icons" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="material-icon.html"><span class="nav-text"> متریال آیکون </span></a></li>
                                    <li><a class="sidenav-item-link" href="font-awsome-icons.html"><span class="nav-text"> فونت آوسام آیکون </span></a></li>
                                    <li><a class="sidenav-item-link" href="flag-icon.html"><span class="nav-text"> فلگ آیکون </span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-image-filter-none"></i> <span class="nav-text"> صفحات دیگر </span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="otherpages" data-parent="#sidebar-menu">
                                    <li class="has-sub"><a href="404.html"> صفحه 404 </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ec-page-wrapper">
            <header class="ec-main-header" id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg"><button id="sidebar-toggler" class="sidebar-toggle"></button>
                    <div class="search-form d-lg-inline-block">
                        <div class="input-group"><input name="query" id="search-input" class="form-control" placeholder="جستجو..." autofocus="" autocomplete="off"> <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="mdi mdi-magnify"></i></button></div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>
                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user-menu"><button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/img/user/user.png" class="user-image" alt="User Image"></button>
                                <ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
                                    <li class="dropdown-header"><img src="assets/img/user/user.png" class="img-circle" alt="User Image">
                                        <div class="d-inline-block"> جلال شمس <small class="pt-1"><a class="__cf_email__" data-cfemail="4c262324226229342d213c20290c2b212d2520622f2321">john.example@gmail.com</a></small>
                                        </div>
                                    </li>
                                    <li><a href="user-profile.html"><i class="mdi mdi-account"></i>پروفایل من </a></li>
                                    <li><a href="#"><i class="mdi mdi-email"></i> پیام </a></li>
                                    <li><a href="#"><i class="mdi mdi-diamond-stone"></i> پروژه ها</a></li>
                                    <li class="right-sidebar-in"><a href="javascript:0"><i class="mdi mdi-settings-outline"></i> تنظیمات </a></li>
                                    <li class="dropdown-footer"><a href="index.html"><i class="mdi mdi-logout"></i> خروج </a></li>
                                </ul>
                            </li>
                            <li class="dropdown notifications-menu custom-dropdown"><button class="dropdown-toggle notify-toggler custom-dropdown-toggler"><i class="mdi mdi-bell-outline"></i></button>
                                <div class="card card-default dropdown-notify dropdown-menu-right mb-0">
                                    <div class="card-header card-header-border-bottom px-3">
                                        <h2> اطلاعیه ها </h2>
                                    </div>
                                    <div class="card-body px-0 py-0">
                                        <ul class="nav nav-tabs nav-style-border p-0 justify-content-between" id="myTab" role="tablist">
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link active pb-3" id="home2-tab" data-bs-toggle="tab" data-bs-target="#home2" role="tab" aria-controls="home2" aria-selected="true">همه (10)</a>
                                            </li>
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link pb-3" id="profile2-tab" data-bs-toggle="tab" data-bs-target="#profile2" role="tab" aria-controls="profile2" aria-selected="false">پیام (5)</a></li>
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link pb-3" id="contact2-tab" data-bs-toggle="tab" data-bs-target="#contact2" role="tab" aria-controls="contact2" aria-selected="false">دیگر (5)</a></li>
                                        </ul>
                                        <div class="tab-content" id="myNotifications">
                                            <div class="tab-pane fade show active" id="home2" role="tabpanel">
                                                <ul class="list-unstyled" data-simplebar="" style="height:360px">
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u2.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">نیتین</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 30دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification media-active">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u1.jpg" alt="Image"> <span class="status active"></span>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">لوینا</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-white"><i class="mdi mdi-clock-outline"></i>حالا...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u5.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">کرینال</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification event-active">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                                                <i class="mdi mdi-calendar-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title"> رویدادهای آینده </h4>
                                                                    <p class="last-msg font-size-14">03/02/1401(1عصر -
                                                                        2عصر)</p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 10دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                                <i class="mdi mdi-chart-areaspline font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title"> گزارش فروش سالانه </h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.  </p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                                <i class="mdi mdi-account-multiple-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">درخواست جدید</h4>
                                                                    <p class="last-msg font-size-14">اضافه کردن دنی به لیست دوستان لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از</p><span class="my-1 btn btn-sm btn-success">پذیرفتن</span>
                                                                    <span class="my-1 btn btn-sm btn-secondary">حذف</span>
                                                                    <span class="font-size-12 font-weight-medium text-secondary d-block"><i class="mdi mdi-clock-outline"></i> 5دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                                                <i class="mdi mdi-server-network-off font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">سرور لود شده</h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 30دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-purple text-white">
                                                                <i class="mdi mdi-playlist-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">کار انجام شده</h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 2ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="profile2" role="tabpanel">
                                                <ul class="list-unstyled" data-simplebar="" style="height:360px">
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u6.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">هاردیکو</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u7.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">روانکو</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification media-active">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u1.jpg" alt="Image"> <span class="status active"></span>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">جمیتا</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-white"><i class="mdi mdi-clock-outline"></i>حالا...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u2.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">بالیوی</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="position-relative mr-3"><img class="rounded-circle" src="assets/img/user/u5.jpg" alt="Image"> <span class="status away"></span></div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">برونی</h4>
                                                                    <p class="last-msg">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="contact2" role="tabpanel">
                                                <ul class="list-unstyled" data-simplebar="" style="height:360px">
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification event-active">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                                                <i class="mdi mdi-calendar-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title"> رویدادهای آینده </h4>
                                                                    <p class="last-msg font-size-14">03/02/1401(1عصر -
                                                                        2عصر)</p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 10دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                                <i class="mdi mdi-chart-areaspline font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">گزارش فروش جدید</h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.  </p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 1ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                                <i class="mdi mdi-account-multiple-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">درخواست جدید</h4>
                                                                    <p class="last-msg font-size-14">اضافه کردن دنی به لیست دوستان لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از</p><span class="my-1 btn btn-sm btn-success">پذیرفتن</span>
                                                                    <span class="my-1 btn btn-sm btn-secondary">حذف</span>
                                                                    <span class="font-size-12 font-weight-medium text-secondary d-block"><i class="mdi mdi-clock-outline"></i> 5دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-danger text-white">
                                                                <i class="mdi mdi-server-network-off font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">سرور لود شده</h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                                                    <span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 30دقیقه...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                    <li><a href="javscript:void(0)" class="media media-message media-notification">
                                                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-purple text-white">
                                                                <i class="mdi mdi-playlist-check font-size-20"></i>
                                                            </div>
                                                            <div class="media-body d-flex justify-content-between">
                                                                <div class="message-contents">
                                                                    <h4 class="title">گزارش کار انجام شده </h4>
                                                                    <p class="last-msg font-size-14">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p><span class="font-size-12 font-weight-medium text-secondary"><i class="mdi mdi-clock-outline"></i> 2ساعت قبل...</span>
                                                                </div>
                                                            </div>
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-right d-none">
                                    <li class="dropdown-header"> شما 5 اطلاعیه دارید </li>
                                    <li><a href="#"><i class="mdi mdi-account-plus"></i> کاربر جدید ثبت شده است <span class="font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 صبح</span></a></li>
                                    <li><a href="#"><i class="mdi mdi-account-remove"></i> کاربر حذف شده <span class="font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 صبح</span></a></li>
                                    <li><a href="#"><i class="mdi mdi-chart-areaspline"></i> گزارش فروش آماده است <span class="font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 عصر</span></a></li>
                                    <li><a href="#"><i class="mdi mdi-account-supervisor"></i> مشتری جدید <span class="font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 صبح</span></a></li>
                                    <li><a href="#"><i class="mdi mdi-server-network-off"></i> سرور بیش از حد استفاده شده <span class="font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 صبح</span></a></li>
                                    <li class="dropdown-footer"><a class="text-center" href="#"> مشاهده همه </a></li>
                                </ul>
                            </li>
                            <li class="right-sidebar-in right-sidebar-2-menu"><i class="mdi mdi-settings-outline mdi-spin"></i></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="ec-content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-1">
                                <div class="card-body">
                                    <h2 class="mb-1"><?php echo $total_users;?></h2>
                                    <p>تعداد کل کاربران  </p><span class="mdi mdi-account-arrow-left"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-2">
                                <div class="card-body">
                                    <h2 class="mb-1"><?php echo $total_seller_orders;?></h2>
                                    <p>تعداد کل سفارش شما  </p><span class="mdi mdi-account-clock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-3">
                                <div class="card-body">
                                    <h2 class="mb-1"><?php echo $total_orders;?></h2>
                                    <p>تعداد کل سفارش ها </p><span class="mdi mdi-package-variant"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                            <div class="card card-mini dash-card card-4">
                                <div class="card-body">
                                    <h2 class="mb-1"><?php echo $total_income;?></h2>
                                    <p>درآمد کل فروشنده</p><span class="mdi mdi-currency-usd"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-xl-8 col-md-12 p-b-15">
                            <div id="user-acquisition" class="card card-default">
                                <div class="card-header">
                                    <h2> گزارش فروش </h2>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab" aria-selected="true"> امروز </a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab" aria-selected="false">ماهانه</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab" aria-selected="false">سالانه</a></li>
                                    </ul>
                                    <div class="tab-content pt-4" id="salesReport">
                                        <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                                            <div class="mb-6" style="max-height:247px"><canvas id="acquisition" class="chartjs2"></canvas>
                                                <div id="acqLegend" class="customLegend mb-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row justify-content-center mb-4"> 
                             <div class=" col-xl-8 col-md-12 p-b-15 col-12 mb-4">
                          <div id="user-acquisition-yearly" class="card card-default" style="width: 100%; " >
                                 <div class="card-header">
                                       <h2>گزارش فروش سالانه</h2>
                                   </div>
                            <div class="card-body" >
                         <div class="mb-6" style="max-height:300px">
                          <canvas id="chartYearlySales"></canvas>
                         <div id="legendYearlySales" class="customLegend mb-2"></div>
                        </div>
                        </div>
             </div>
            </div></div>
                      



                        <!-- <div class="col-xl-4 col-md-12 p-b-15">
                            <div class="card card-default">
                                <div class="card-header justify-content-center">
                                    <h2>نظارت بر سفارشات</h2>
                                </div>
                                <div class="card-body"><canvas id="doChart"></canvas></div><a href="#" class="pb-5 d-block text-center text-muted"><i class="mdi mdi-download mr-2"></i>
                                    گزارش کلی دانلود</a>
                                <div class="card-footer d-flex flex-wrap bg-white p-0">
                                    <div class="col-6">
                                        <div class="p-20">
                                            <ul class="d-flex flex-column justify-content-between">
                                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#4c84ff"></i>سفارش کامل شده</li>
                                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#80e1c1"></i>سفارش بدون پرداخت</li>
                                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#ff7b7b"></i>سفارش بازگشت</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-6 border-left">
                                        <div class="p-20">
                                            <ul class="d-flex flex-column justify-content-between">
                                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#8061ef"></i>سفارش در انتظار</li>
                                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#ffa128"></i>سفارش لغو شد</li>
                                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color:#7be6ff"></i>سفارش شکسته</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- </div> -->
                    <!-- <div class="row">
                        <div class="col-xl-8 col-md-12 p-b-15">
                            <div class="card card-default" id="user-activity">
                                <div class="no-gutters">
                                    <div>
                                        <div class="card-header justify-content-between">
                                            <h2>فعالیت کاربر</h2>
                                            <div class="date-range-report"><span></span></div>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="userActivityContent">
                                                <div class="tab-pane fade show active" id="user" role="tabpanel"><canvas id="activity" class="chartjs"></canvas></div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex flex-wrap bg-white border-top"><a href="#" class="text-uppercase py-3">مرور جزئیات</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12 p-b-15">
                            <div class="card card-default">
                                <div class="card-header flex-column align-items-start">
                                    <h2>کاربران فعلی</h2>
                                </div>
                                <div class="card-body"><canvas id="currentUser" class="chartjs"></canvas></div>
                                <div class="card-footer d-flex flex-wrap bg-white border-top"><a href="#" class="text-uppercase py-3">گزارش جزئیات</a></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-xl-8 col-12 p-b-15">
                            <div class="card card-default" id="analytics-country">
                                <div class="card-header justify-content-between">
                                    <h2>خریداری شده توسط کشور</h2>
                                    <div class="date-range-report"><span></span></div>
                                </div>
                                <div class="card-body vector-map-world-2">
                                    <div id="regions_purchase" style="height:100%;width:100%"></div>
                                </div>
                                <div class="border-top mt-3">
                                    <div class="row no-gutters">
                                        <div class="col-lg-6">
                                            <div class="world-data-chart border-bottom pt-15px pb-15px"><canvas id="hbar1" class="chartjs"></canvas></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="world-data-chart pt-15px pb-15px"><canvas id="hbar2" class="chartjs"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex flex-wrap bg-white"><a href="#" class="text-uppercase py-3">گزارش جزئیات</a></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12 p-b-15">
                            <div class="card card-default Sold-card-table">
                                <div class="card-header justify-content-between">
                                    <h2>فروش کشورها </h2>
                                    <div class="tools"><button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                                        <div class="dropdown show d-inline-block widget-dropdown"><a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-units" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li class="dropdown-item"><a href="#">فعالیت</a></li>
                                                <li class="dropdown-item"><a href="#">فعالیت دیگر</a></li>
                                                <li class="dropdown-item"><a href="#">یک فعالیت دیگر</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-0 compact-units" data-simplebar="" style="height:534px">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-dark">کوله پشتی</td>
                                                <td class="text-center">9</td>
                                                <td class="text-right">33% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">تی شرت</td>
                                                <td class="text-center">6</td>
                                                <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">روکش</td>
                                                <td class="text-center">3</td>
                                                <td class="text-right">50% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">گردنبند</td>
                                                <td class="text-center">7</td>
                                                <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">شلوار جین</td>
                                                <td class="text-center">10</td>
                                                <td class="text-right">300% <i class="mdi mdi-arrow-down-bold text-danger pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">کفش</td>
                                                <td class="text-center">5</td>
                                                <td class="text-right">100% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">تی شرت</td>
                                                <td class="text-center">6</td>
                                                <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">ساعت </td>
                                                <td class="text-center">18</td>
                                                <td class="text-right">160% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">درونی</td>
                                                <td class="text-center">156</td>
                                                <td class="text-right">120% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark">تی شرت</td>
                                                <td class="text-center">6</td>
                                                <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex flex-wrap bg-white"><a href="#" class="text-uppercase py-3"> مشاهده گزارش </a></div>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- لیست سفارشات اخیر -->
                    <div class="row">
                        <div class="col-12 p-b-15">
                            <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                                <div class="card-header justify-content-between">
                                    <h2>سفارشات اخیر</h2>
                                    <!-- <div class="date-range-report"><span></span></div> -->
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ایدی سفارش</th>
                                                <th>نام محصول</th>
                                                <th class="d-none d-lg-table-cell">تعداد</th>
                                                <th class="d-none d-lg-table-cell">تاریخ سفارش</th>
                                                <th class="d-none d-lg-table-cell">هزینه سفارش</th>
                                                <th>تصویر</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row=mysqli_fetch_assoc($result_recent_orders)):?>
                                            <tr>
                                                <td><?php echo $row['order_id'];?></td>
                                                <td><a class="text-dark" href="#"><?php echo htmlspecialchars( $row['product_name']);?></a></td>
                                                <td class="d-none d-lg-table-cell"><?php echo htmlspecialchars( $row['quantity']);?></td>
                                                <td class="d-none d-lg-table-cell"> <?php echo jdate('d F Y', strtotime($row['order_time'])); ?> </td>
                                                <td class="d-none d-lg-table-cell"> <?php echo htmlspecialchars( $row['price']);?></td>
                                                <td><span class="badge badge-success"> <img src="../ekka-html/assets/images/products/<?php echo htmlspecialchars( $row['product_image']);?>" style="width: 50px; height:auto;" ></span></td>
                                                <td class="text-right">
                                                    <div class="dropdown show d-inline-block widget-dropdown"><a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li class="dropdown-item"><a href="product-detail.php?id=<?php echo $row['order_id'];?>"> مشاهده </a></li>
                                                            <!-- <li class="dropdown-item"><a href="#"> حذف </a></li> -->
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                      <?php endwhile;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="card ec-cust-card card-table-border-none card-default">
                                <div class="card-header justify-content-between">
                                    <h2>مشتریان جدیدا اضافه شده</h2>
                                </div>
                                <div class="card-body pt-0 pb-15px">
                                    <table class="table">
                                        <tbody>
                                            <?php if(mysqli_num_rows($res_new_users)==0): ?>
                                                <tr>
                                                    <td>مشتری جدیدی ثبتنام نکرده است</td>
                                                </tr>
                                                <?php 
                                            else: 
                                            while($user=mysqli_fetch_assoc($res_new_users)):
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-image mr-3 rounded-circle"><a href="user-profile.html?id=<?php echo $user['id'];?>"><img class="profile-img rounded-circle w-45" src="assets/img/user/u1.jpg" alt="customer image"></a></div>
                                                        <div class="media-body align-self-center"><a href="profile.html">
                                                                <h6 class="mt-0 text-dark font-weight-medium"><?php echo $user['name'];?>
                                                                   </h6>
                                                            </a> <small><?php echo $user['username'];?></small></div>
                                                    </div>
                                                </td>
                                                <td><?php echo $user['total_orders'];?> سفارش</td>
                                                <td class="text-dark d-none d-md-block"> تومان <?php echo number_format($user['total_spent']); ?></td>
                                                <?php
                                                endwhile;
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="card card-default ec-card-top-prod">
                                <div class="card-header justify-content-between">
                                    <h2>محصولات برتر</h2>
                                    
                                </div>
                                <div class="card-body mt-10px mb-10px py-0" >
                                    <?php if(mysqli_num_rows($res_top_product)==0):?>
                                        <p class="text-center py-4">محصول فروخته شده وجود ندارد</p>
                                        <?php else: 
                                            while($row=mysqli_fetch_assoc($res_top_product)):
                                            ?>
                                    <div class="row media d-flex pt-15px pb-15px">
                                        <div class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded"><a href="product-detail.php?id=<?php echo $row['id'];?>"><img src="../ekka-html/assets/images/products/<?php echo $row['image'];?>" alt="customer image"></a>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos"><a href="#">
                                                <h6 class="mb-10px text-dark font-weight-medium"><?php echo $row['name'];?>  </h6>
                                            </a>
                                            <p class="float-md-right sale"><span class="mr-2"> <?php echo $row['category'];?>:دسته بندی</span></p>
                                            <!-- <p class="d-none d-md-block">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p> -->
                                            <p class="mb-0 ec-price"><span class="text-dark"><?php echo $row['price'];?> تومان</span> 
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                    endwhile;
                                endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>&copy;  کپی رایت  <span>1401</span><a class="text-primary" href="index.html" target="_blank"> داشبرد مدیریتی اکا </a>.
                       همه حقوق محفوظ است.</p>
                </div>
            </footer>
        </div>
    </div>
    <script data-cfasync="false" src="assets/plugins/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery.notify.min.js"></script>
    <script src="assets/plugins/jquery/jquery.bundle.notify.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/simplebar/simplebar.min.js"></script>
    <script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    <script src="assets/plugins/slick/slick.min.js"></script>
    <script src="assets/plugins/charts/Chart.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/plugins/charts/google-map-loader.js"></script>
    <script src="assets/plugins/charts/google-map.js"></script>

    <script src="assets/plugins/daterangepicker/moment.min.js"></script>
    
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src='assets/plugins/daterangepicker/moment-jalaali.js'></script>
    <script src="assets/plugins/daterangepicker/fa.js"></script> 
    <script src="assets/js/date-range.js"></script>
    <script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
    <script src="assets/js/ekka.js"></script>
    <!-- نمودار فروش -->
    <script>
var ctxYearly = document.getElementById('chartYearlySales').getContext('2d');
var chartYearlySales = new Chart(ctxYearly, {
    type: 'bar',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            label: 'فروش ماهانه (تومان)',
            data: <?php echo $data; ?>,
            backgroundColor: '#4e73df'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>

</html>