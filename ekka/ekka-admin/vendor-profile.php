<?php 
session_start();
include('../../config/db.php'); // اتصال به دیتابیس

if(!isset($_SESSION['sellers_id'])){
    header("Location: sign-in.html");
    exit();
}
$seller_id=intval($_SESSION['sellers_id']);

//گرفتن اطلاعات فروشنده از دیتابیس
$sql="SELECT*FROM sellers WHERE id=$seller_id";
$result=mysqli_query($conn,$sql);
//بررسی وجود نتیجه
if($result&&mysqli_num_rows($result)>0){
    $sellers=mysqli_fetch_assoc($result);
}else{
    die("اظلاعات فروشنده یافت نشد");
}

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
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Ekka - Admin Dashboard HTML Template.">
    <title>اکا - داشبرد مدیریتی اچ تی ام ال</title>
      
     
    <link href="assets/css/materialdesignicons.min.css" rel="stylesheet">    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet">
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css">
    <link href="assets/img/favicon.png" rel="shortcut icon">
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">
    <div class="wrapper">
        <div class="ec-left-sidebar ec-bg-sidebar">
            <div id="sidebar" class="sidebar ec-sidebar-footer">
                <div class="ec-brand"><a href="index.html" title="Ekka"><img class="ec-brand-icon" src="assets/img/logo/ec-site-logo.png" alt=""> <span class="ec-brand-name text-truncate">اکا </span></a></div>
                <div class="ec-navigation" data-simplebar="">
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li><a class="sidenav-item-link" href="index.html"><i class="mdi mdi-view-dashboard-outline"></i> <span class="nav-text">داشبرد</span></a>
                            <hr>
                        </li>
                        <li class="has-sub active expand"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-account-group-outline"></i> <span class="nav-text">فروشندگان</span> <b class="caret"></b></a>
                            <div class="collapse show">
                                <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="vendor-card.html"><span class="nav-text">گرید فروشندگان</span></a></li>
                                    <li><a class="sidenav-item-link" href="vendor-list.html"><span class="nav-text">لیست فروشندگان</span></a></li>
                                    <li class="active"><a class="sidenav-item-link" href="vendor-profile.html"><span class="nav-text">پروفایل فروشنده</span></a></li>
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
                                        <div class="d-inline-block"> جلال شمس <small class="pt-1"><a class="__cf_email__" data-cfemail="ee84818680c08b968f839e828bae89838f8782c08d8183">john.example@gmail.com</a></small>
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
                                        <ul class="nav nav-tabs nav-style-border p-0 justify-content-between" id="myNotificationTab" role="tablist">
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link active pb-3" id="home2-tab" data-bs-toggle="tab" data-bs-target="#home2" role="tab" aria-controls="home2" aria-selected="true">همه (10)</a>
                                            </li>
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link pb-3" id="profile2-tab" data-bs-toggle="tab" data-bs-target="#profile2" role="tab" aria-controls="profile2" aria-selected="false">پیام (5)</a></li>
                                            <li class="nav-item mx-3 my-0 py-0"><a href="#" class="nav-link pb-3" id="contact2-tab" data-bs-toggle="tab" data-bs-target="#contact2" role="tab" aria-controls="contact2" aria-selected="false">دیگر (5)</a></li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent3">
                                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home2-tab">
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
                                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile2-tab">
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
                                            <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
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
                    <div class="breadcrumb-wrapper breadcrumb-contacts">
                        <div>
                            <h1> نمایه فروشنده </h1>
                            <p class="breadcrumbs"><span><a href="index.html">خانه</a></span> <span><i class="mdi mdi-chevron-left"></i></span>پروفایل</p>
                        </div>
                        <div><a href="vendor-list.html" class="btn btn-primary">ویرایش</a></div>
                    </div>
                    <div class="card bg-white profile-content ec-vendor-profile">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="profile-content-left profile-left-spacing">
                                    <div class="ec-disp">
                                        <div class="text-center widget-profile px-0 border-0">
                                            <div class="card-img mx-auto rounded-circle"><img src="assets/img/user/u6.jpg" alt="user image"></div>
                                            <div class="card-body">
                                                <h4 class="py-2 text-dark"><?php echo htmlspecialchars($sellers['name']);?> </h4>
                                                <!-- <h4 class="py-2 text-dark"></h4> -->
                                                <!-- <p><a class="__cf_email__" data-cfemail="ffb5909791d19a879e928f939abf98929e9693d19c9092">john.example@gmail.com</a>
                                                </p><a class="btn btn-primary my-3" href="#">دنبال کردن</a> -->
                                            </div>
                                        </div>
                                        <!-- <div class="d-flex justify-content-between">
                                            <div class="text-center pb-4">
                                                <h6 class="text-dark pb-2">1703</h6>
                                                <p>دوستان</p>
                                            </div>
                                            <div class="text-center pb-4">
                                                <h6 class="text-dark pb-2">3005</h6>
                                                <p>فالوور</p>
                                            </div>
                                            <div class="text-center pb-4">
                                                <h6 class="text-dark pb-2">1150</h6>
                                                <p>فالویینگ</p>
                                            </div>
                                        </div> -->
                                    </div>
                                    <hr class="w-100">
                                    <div class="contact-info pt-4">
                                        <h5 class="text-dark">اطلاعات تماس</h5>
                                        <p class="text-dark font-weight-medium pt-24px mb-2"> آدرس ایمیل </p>
                                        <p><a class="__cf_email__" ><?php echo htmlspecialchars($sellers['email']);?></a>
                                        </p>
                                        <p class="text-dark font-weight-medium pt-24px mb-2"> شماره تلفن </p>
                                        <p><?php echo htmlspecialchars($sellers['mobile_number']);?></p>
                                        <!-- <p class="text-dark font-weight-medium pt-24px mb-2"> تاریخ تولد</p>
                                        <p>خرداد 10, 1401</p> -->
                                        <!-- <p class="text-dark font-weight-medium pt-24px mb-2"> مشخصات اجتماعی </p>
                                        <p class="social-button"><a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle"><i class="mdi mdi-twitter"></i></a> <a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle"><i class="mdi mdi-linkedin"></i></a> <a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle"><i class="mdi mdi-facebook"></i></a> <a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle"><i class="mdi mdi-skype"></i></a></p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-9">
                                <div class="profile-content-right profile-right-spacing py-5">
                                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                                        <li class="nav-item" role="presentation"><button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">پروفایل</button></li>
                                        <li class="nav-item" role="presentation"><button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">تنظیمات</button></li>
                                    </ul>
                                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="tab-widget mt-5">
                                                <div class="row">
                                                    <!-- <div class="col-xl-4">
                                                        <div class="media widget-media p-3 bg-white border">
                                                            <div class="icon rounded-circle mr-3 bg-primary"><i class="mdi mdi-account-outline text-white"></i>
                                                            </div>
                                                            <div class="media-body align-self-center">
                                                                <h4 class="text-primary mb-2">5300</h4>
                                                                <p>کاربران جدید</p>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-xl-4">
                                                        <div class="media widget-media p-3 bg-white border">
                                                            <div class="icon rounded-circle bg-warning mr-3"><i class="mdi mdi-cart-outline text-white"></i></div>
                                                            <div class="media-body align-self-center">
                                                                <h4 class="text-primary mb-2">1953</h4>
                                                                <p>سفارش ثبت شد</p>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-xl-4">
                                                        <div class="media widget-media p-3 bg-white border">
                                                            <div class="icon rounded-circle mr-3 bg-success"><i class="mdi mdi-diamond-stone text-white"></i></div>
                                                            <div class="media-body align-self-center">
                                                                <h4 class="text-primary mb-2"><?php echo $total_income;?></h4>
                                                                <p>کل فروش</p>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="card card-default mb-24px">
                                                            
                                                            <div class="card-body compact-notifications" data-simplebar="" style="height:434px">
                                                                <div class="media pb-3 align-items-center justify-content-between">
                                                                    <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                                        <i class="mdi mdi-cart-outline font-size-20"></i>
                                                                    </div>
                                                                    <div class="media-body pr-3"><a class="mt-0 mb-1 font-size-15 text-dark" href="#">سفارش جدید</a>
                                                                        <p>سلنا سفارش جدیدی داده است</p>
                                                                    </div><span class="font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10
                                                                        صبح</span>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="card card-default card-table-border-none ec-tbl" id="recent-orders">
                                                            <div class="card-header justify-content-between">
                                                                <h2>اخیر سفارش</h2>
                                                                
                                                            </div>
                                                            <!-- <div class="card-body pt-0 pb-0 table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>شماره سفارش</th>
                                                                            <th>نام محصول</th>
                                                                            <th>واحد</th>
                                                                            <th>تاریخ سفارش</th>
                                                                            <th>هزینه سفارش</th>
                                                                            <th>وضعیت</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>24541</td>
                                                                            <td><a class="text-dark" href="#">مربی ورزشی
                                                                                    با صدای بلند</a></td>
                                                                            <td>1 واحد</td>
                                                                            <td>دی 20, 1399</td>
                                                                            <td> 230 تومان</td>
                                                                            <td><span class="badge badge-success">تکمیل شده</span>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                                                        <li class="dropdown-item"><a href="#"> مشاهده </a></li>
                                                                                        <li class="dropdown-item"><a href="#"> حذف </a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>24541</td>
                                                                            <td><a class="text-dark" href="#">
                                                                                    کفش ، ساعت گوچی</a></td>
                                                                            <td>2 واحد</td>
                                                                            <td>آذر 15, 1399</td>
                                                                            <td>550 تومان</td>
                                                                            <td><span class="badge badge-warning"> تاخیر </span>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order2">
                                                                                        <li class="dropdown-item"><a href="#"> مشاهده </a></li>
                                                                                        <li class="dropdown-item"><a href="#"> حذف </a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>24541</td>
                                                                            <td><a class="text-dark" href="#">کلاه مشکی کلاه</a></td>
                                                                            <td>1 واحد</td>
                                                                            <td>آذر 18, 1399</td>
                                                                            <td> 325 تومان</td>
                                                                            <td><span class="badge badge-warning"> در انتظار</span></td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order3">
                                                                                        <li class="dropdown-item"><a href="#"> مشاهده </a></li>
                                                                                        <li class="dropdown-item"><a href="#"> حذف </a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>24541</td>
                                                                            <td><a class="text-dark" href="#">مردمان کوله پشتی ، پوست کلاه شنا</a></td>
                                                                            <td>5 واحد</td>
                                                                            <td>خرداد 13, 1399</td>
                                                                            <td>200 تومان</td>
                                                                            <td><span class="badge badge-success">تکمیل شده</span>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order4">
                                                                                        <li class="dropdown-item"><a href="#"> مشاهده </a></li>
                                                                                        <li class="dropdown-item"><a href="#"> حذف </a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>24541</td>
                                                                            <td><a class="text-dark" href="#">سرعت ایگنات</a></td>
                                                                            <td>1 واحد</td>
                                                                            <td>خرداد 23, 1399</td>
                                                                            <td>150 تومان</td>
                                                                            <td><span class="badge badge-danger"> لغو شده </span>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">
                                                                                        <li class="dropdown-item"><a href="#"> مشاهده </a></li>
                                                                                        <li class="dropdown-item"><a href="#"> حذف </a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div> -->
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
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                            <!-- <div class="tab-pane-content mt-5">
                                                <?php
                                                if(isset($_POST['update'])){
                                                    $name=mysqli_real_escape_string($conn,$_POST['name']);
                                                    $email=mysqli_real_escape_string($conn,$_POST['email']);
                                                    $mobile_number=mysqli_real_escape_string($conn,$_POST['mobile_number']);
                                                     $username=mysqli_real_escape_string($conn,$_POST['username']);
                                                    $password=trim($_POST['password']); 
                                                    //کرفتن عکس فعلی از دیتابیس
                                                    $image=$sellers['image'];
                                                    //اگر عکس حدید وارد شد
                                                    if(!empty($_FILES["image"]["name"])){
                                                        $target_dir="uploads/;";
                                                        if(!is_dir($target_dir)) mkdir($target_dir,0777,true);
                                                        $file_name=time()."_" . basename($file_name);
                                                        //انتقال فایل به مسیر فایل اپلود
                                                        if(move_uploaded_file($_FILES["image"]["name"],$target_dir)){
                                                            $image=$file_name;
                                                        }
                                                    }
                                                    //اگر رمز وارد شده بود رمز جدید هش شود
                                                    if(!empty($password)){
                                                        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
                                                        $update_sql="UPDATE sellers
                                                        SET name='$name',email='$email',mobile_number='$mobile_number',password='$hashed_password',image='$image'
                                                        WHERE id=$sellers_id";
                                                    }
                                                    if(mysqli_query($conn,$update_sql)){
                                                        echo "<script>alert('باموفقیت بروزرسانی شد');window.location.href='vendor-profile.php';</script>";
                                                    }else{
                                                        echo "<script>alert('خطا در بروزرسانی اطلاعات');</script>";
                                                    }    
                                                }

                                                ?>
                                                <form method="POST" action="" enctype="multipart/form-data">
                                                    <div class="form-group row mb-6"><label for="coverImage" class="col-sm-4 col-lg-2 col-form-label"> کاربر تصویر </label>
                                                    <?php if (!empty($sellers['image'])): ?><img src="uploads/<?php echo htmlspecialchars($sellers['image']); ?>" width="100" style="margin-bottom:10px;">
                                                      <?php endif; ?>
                                                        <div class="col-sm-8 col-lg-10">
                                                            <input type="file" name="profile_image" class="form-control">
                                                            <!-- <div class="custom-file mb-1"><input type="file" class="custom-file-input" id="coverImage" required=""><label class="custom-file-label" for="coverImage">انتخاب فایل...</label>
                                                                <div class="invalid-feedback"> مثال سفارشی نامعتبر
                                                                    بازخورد پرونده </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                 <label for="firstName">نام</label>
                                                                 <!-- <input class="form-control" id="firstName" value="نام">  -->
                                                                <input type="text" name="name" value="<?php echo htmlspecialchars($sellers['name']); ?>" class="form-control">
                                                        </div>
                                                            </div>
                                                            
                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group"><label for="lastName">نام خانوادگی</label>
                                                            <input class="form-control" id="lastName" value="نام خانوادگی"></div>
                                                        </div> -->
                                                    </div>
                                                    <div class="form-group mb-4"><label for="userName">نام کاربری</label><input type="text" name="username" value="<?php echo htmlspecialchars($sellers['username']); ?>" class="form-control"> </div>
                                                    <!-- <div class="form-group mb-4"><label for="email">ایمیل:</label><input type="email" class="form-control" id="email" value="ekka.example@gmail.com"></div> -->
                                                    <div class="form-group mb-4"><label for="oldPassword">پسورد جدید</label> <input type="text" name="password" value="<?php echo htmlspecialchars($sellers['password']); ?>" class="form-control"></div>
                                                    <!-- <div class="form-group mb-4"><label for="newPassword">پسورد جدید</label><input type="password" name="password" class="form-control"></div>
                                                    <div class="form-group mb-4"><label for="conPassword"> تایید پسورد </label><input type="password" class="form-control" id="conPassword"></div> -->
                                                    <div class="d-flex justify-content-end mt-5">    <button type="submit" name="update" class="btn btn-primary">بروزرسانی اطلاعات</button></div>
                                                </form>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>&copy;  کپی رایت  <span>1401</span><a class="text-primary" href="vendor-profile.html" target="_blank"> داشبرد مدیریتی اکا </a>.
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
    <script src="assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/date-range.js"></script>
    <script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
    <script src="assets/js/ekka.js"></script>
                                                    </body>
</html>