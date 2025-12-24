<?php
include('../../config/db.php'); // اتصال به دیتابیس
include('../../config/jdf.php');
// فرض: $order_id از URL گرفته شده
if (!isset($_GET['id'])) {
    die("شناسه سفارش مشخص نشده است.");
}

$order_id = (int) $_GET['id'];

// گرفتن اطلاعات سفارش و کاربر و محصولات
$sql = "
SELECT 
    o.id AS order_id,
    o.user_id AS buyer_id,
    o.product_id,
    o.quantity AS order_quantity,
    o.price AS order_price,
    o.order_time AS order_at,
    b.name AS product_name,
    b.image AS product_image,
    b.price AS product_unit_price,
    u.name AS buyer_name,
    u.email AS buyer_email,
    u.mobile_number AS buyer_mobile,
    u.address AS buyer_address,
    u.country AS buyer_country,
    u.postal_code AS buyer_postal_code
FROM orders o
JOIN books b ON o.product_id = b.id
JOIN users u ON o.user_id = u.id
WHERE o.id = $order_id
";

$res = mysqli_query($conn, $sql);
if (!$res) {
    die("خطا در اجرای کوئری: " . mysqli_error($conn));
}

if (mysqli_num_rows($res) == 0) {
    die("سفارشی با این شناسه پیدا نشد.");
}

// همه ردیف‌ها (چون ممکنه چند محصول در یک سفارش باشد)
$products = [];
while ($row = mysqli_fetch_assoc($res)) {
    $buyer_info = [
        'name' => $row['buyer_name'],
        'email' => $row['buyer_email'],
        'mobile' => $row['buyer_mobile'],
        'address' => $row['buyer_address'],
        'country' => $row['buyer_country'],
        'order_time' => $row['order_at']
    ];

    $products[] = [
        'name' => $row['product_name'],
        'image' => $row['product_image'],
        'unit_price' => $row['product_unit_price'],
        'quantity' => $row['order_quantity'],
        'total_price' => $row['order_price']
    ];
}

//جمع مبالغ
$total_price=0;
foreach($products as $item){
    $total_price+=$item['total_price'];
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
                                    <!-- <li><a class="sidenav-item-link" href="vendor-card.html"><span class="nav-text">گرید فروشندگان</span></a></li> -->
                                    <li><a class="sidenav-item-link" href="vendor-list.html"><span class="nav-text">لیست فروشندگان</span></a></li>
                                    <li><a class="sidenav-item-link" href="vendor-profile.html"><span class="nav-text">پروفایل فروشنده</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-account-group"></i> <span class="nav-text">کاربران</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                                    <!-- <li><a class="sidenav-item-link" href="user-card.html"><span class="nav-text">گرید کاربران</span></a></li> -->
                                    <li><a class="sidenav-item-link" href="user-list.html"><span class="nav-text">لیست کاربران</span></a></li>
                                    <!-- <li><a class="sidenav-item-link" href="user-profile.html"><span class="nav-text">پروفایل کاربر</span></a></li> -->
                                </ul>
                            </div>
                            <hr>
                        </li>
                        <!-- <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-dns-outline"></i> <span class="nav-text">دسته‌بندی‌ها</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="main-category.html"><span class="nav-text">دسته‌بندی‌ اصلی</span></a></li>
                                    <li><a class="sidenav-item-link" href="sub-category.html"><span class="nav-text">دسته‌بندی‌ فرعی</span></a></li>
                                </ul>
                            </div>
                        </li> -->
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-palette-advanced"></i> <span class="nav-text">محصولات</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="product-add.html"><span class="nav-text">افزودن محصول</span></a></li>
                                    <li><a class="sidenav-item-link" href="product-list.html"><span class="nav-text">لیست  کل محصولات</span></a></li>
                                    <li><a class="sidenav-item-link" href="product-grid.html"><span class="nav-text">گرید محصولات شما(فروشنده)</span></a></li>
                                    <!-- <li><a class="sidenav-item-link" href="product-detail.html"><span class="nav-text">جزییات محصول</span></a></li> -->
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-cart"></i> <span class="nav-text">سفارشات</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                                    <!-- <li><a class="sidenav-item-link" href="new-order.html"><span class="nav-text">سفارش جدید</span></a></li> -->
                                    <li><a class="sidenav-item-link" href="order-history.html"><span class="nav-text">گزارش سفارش </span></a></li>
                                    <!-- <li><a class="sidenav-item-link" href="order-detail.html"><span class="nav-text">جزییات سفارش </span></a></li> -->
                                    <!-- <li><a class="sidenav-item-link" href="invoice.html"><span class="nav-text">فاکتور </span></a></li> -->
                                </ul>
                            </div>
                        </li>
                        <!-- <li><a class="sidenav-item-link" href="review-list.html"><i class="mdi mdi-star-half"></i> <span class="nav-text">نظرات</span></a></li> -->
                        <!-- <li><a class="sidenav-item-link" href="brand-list.html"><i class="mdi mdi-tag-faces"></i> <span class="nav-text">برند ها</span></a> -->
                            <hr>
                        </li>
                        <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-login"></i> <span class="nav-text">احراز هویت</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="authentication" data-parent="#sidebar-menu">
                                    <li><a href="sign-in.html"><span class="nav-text">ورود</span></a></li>
                                    <li><a href="sign-up.html"><span class="nav-text">ثبت نام</span></a></li>
                                     <li><a href="sign-in.html"><span class="nav-text"> خروج</span></a></li>

                                </ul>
                            </div>
                        </li>
                        <!-- <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-diamond-stone"></i> <span class="nav-text">آیکون ها</span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="icons" data-parent="#sidebar-menu">
                                    <li><a class="sidenav-item-link" href="material-icon.html"><span class="nav-text"> متریال آیکون </span></a></li>
                                    <li><a class="sidenav-item-link" href="font-awsome-icons.html"><span class="nav-text"> فونت آوسام آیکون </span></a></li>
                                    <li><a class="sidenav-item-link" href="flag-icon.html"><span class="nav-text"> فلگ آیکون </span></a></li>
                                </ul>
                            </div>
                        </li> -->
                        <!-- <li class="has-sub"><a class="sidenav-item-link" href="javascript:void(0)"><i class="mdi mdi-image-filter-none"></i> <span class="nav-text"> صفحات دیگر </span> <b class="caret"></b></a>
                            <div class="collapse">
                                <ul class="sub-menu" id="otherpages" data-parent="#sidebar-menu">
                                    <li class="has-sub"><a href="404.html"> صفحه 404 </a></li>
                                </ul>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="ec-page-wrapper">
            <header class="ec-main-header" id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg"><button id="sidebar-toggler" class="sidebar-toggle"></button>
                    <!-- <div class="search-form d-lg-inline-block">
                        <div class="input-group"><input name="query" id="search-input" class="form-control" placeholder="جستجو..." autofocus="" autocomplete="off"> <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="mdi mdi-magnify"></i></button></div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div> -->
                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                            <!-- <li class="dropdown user-menu"><button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/img/user/user.png" class="user-image" alt="User Image"></button>
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
                            </li> -->
                            <!-- <li class="dropdown notifications-menu custom-dropdown"><button class="dropdown-toggle notify-toggler custom-dropdown-toggler"><i class="mdi mdi-bell-outline"></i></button>
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
                            </li> -->
                            <li class="right-sidebar-in right-sidebar-2-menu"><i class="mdi mdi-settings-outline mdi-spin"></i></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="ec-content-wrapper">
                <div class="content">
                    <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
                        <h1>جزییات سفارش </h1>
                        <p class="breadcrumbs"><span><a href="index.html">خانه</a></span> <span><i class="mdi mdi-chevron-left"></i></span>سفارشات</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="ec-odr-dtl card card-default">
                                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                                    <h2 class="ec-odr">جزییات سفارش <br><span class="small"> شناسه سفارش: #</span></h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6">
                                            <address class="info-grid">
                                                <div class="info-title"><strong> مشتری: </strong></div><br>
                                                <div class="info-content"><?php echo $buyer_info['address'];?> <br>    
                                                    <br> <?php echo $buyer_info['country'];?> <br><abbr title="Phone">شماره تماس:</abbr>
                                                    <?php echo $buyer_info['mobile'];?></div>
                                            </address>
                                        </div>
                                        <div class="col-xl-3 col-lg-6">
                                            <address class="info-grid">
                                                <div class="info-title"><strong>فروشنده  :</strong></div><br>
                                                <div class="info-content">فروشگاه کتاب اکا <br>  <br>   <br><abbr title="Phone"> :</abbr> </div>
                                            </address>
                                        </div>
                                        <div class="col-xl-3 col-lg-6">
                                            <address class="info-grid">
                                                <div class="info-title"><strong>روش پرداخت:</strong></div><br>
                                                <div class="info-content">کارت با پایان **** 1234<br><a class="__cf_email__" data-cfemail="31591f545d50585f5471565c50585d1f525e5c">john.example@gmail.com</a><br>
                                                </div>
                                            </address>
                                        </div>
                                        <div class="col-xl-3 col-lg-6">
                                            <address class="info-grid">
                                                <div class="info-title"><strong> تاریخ سفارش: </strong></div><br>
                                                <div class="info-content"><br><?php  $timestamp=strtotime($buyer_info['order_time']);
                                                                           echo jdate('Y/m/d', $timestamp); ?>  </div>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="tbl-title"> خلاصه محصول </h3>
                                            <div class="table-responsive">
                                                <table class="table table-striped o-tbl">
                                                    <thead>
                                                        <tr class="line">
                                                            <td class="text-center"><strong>تصویر</strong></td>
                                                            <td class="text-center"><strong>محصولات</strong></td>
                                                            <td class="text-center"><strong>قیمت/واحد</strong></td>
                                                            <td class="text-center"><strong>تاریخ</strong></td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            foreach($products as $index=>$prod): ?>
                                                        <tr>
                                                            <td><img class="product-img" src="../ekka-html/assets/images/products/<?php echo $prod['image'];?>" alt=""></td>
                                                            <td><strong><?php echo $prod['name'];?>  </strong><br></td>
                                                            <td class="text-right"> <?php echo number_format($prod['total_price']) ?>تومان</td>
                                                            <td class="text-right"> <?php  $timestamp=strtotime($buyer_info['order_time']);
                                                                           echo jdate('Y/m/d', $timestamp); ?></td>

                                                        </tr>                                                
                                                        <?php endforeach;?>

                                                        <tr>
                                                            <td colspan="4"><?= $index=1 ?></td>
                                                            <td class="text-right"><strong>جمع</strong></td>
                                                            <td class="text-right"><strong><?php echo number_format($total_price);?> تومان</strong></td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td colspan="4"><strong></strong></td>
                                                            <td class="text-right"><strong> وضعیت پرداخت</strong></td>
                                                            <td class="text-right"><strong>پرداخت شده</strong></td>
                                                        </tr> -->
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4 trk-order">
                                <!-- <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">شماره پیگیری سفارش -</span> <span class="text-medium">34VB5540K83</span></div> -->
                                <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                                    <div class="w-100 text-center py-1 px-2"><span class="text-medium">حمل شده
                                            از طريق:</span> یو پی اس </div>
                                    <div class="w-100 text-center py-1 px-2"><span class="text-medium">وضع:</span>
                                        بررسی کیفیت</div>
                                    <!-- <div class="w-100 text-center py-1 px-2"><span class="text-medium">تاریخ تخمینی تحویل:</span> 9 دی 1401 </div> -->
                                </div>
                                <div class="card-body">
                                    <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                        <div class="step completed">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="mdi mdi-cart"></i></div>
                                            </div>
                                            <h4 class="step-title">سفارش تایید شده</h4>
                                        </div>
                                        <div class="step completed">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="mdi mdi-tumblr-reblog"></i></div>
                                            </div>
                                            <h4 class="step-title">در حال پردازش سفارش</h4>
                                        </div>
                                        <div class="step completed">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="mdi mdi-gift"></i></div>
                                            </div>
                                            <h4 class="step-title">محصول اعزام شده</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="mdi mdi-truck-delivery"></i></div>
                                            </div>
                                            <h4 class="step-title">تحویل</h4>
                                        </div>
                                        <div class="step">
                                            <div class="step-icon-wrap">
                                                <div class="step-icon"><i class="mdi mdi-hail"></i></div>
                                            </div>
                                            <h4 class="step-title">محصول تحویل داده شده</h4>
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
                    <p>&copy; کپی رایت<span>1401</span><a class="text-primary" href="order-detail.html" target="_blank"> داشبرد مدیریتی
                            اکا </a>همه حقوق محفوظ است</p>
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
    <script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
    <script src="assets/js/ekka.js"></script>
</body>

</html>