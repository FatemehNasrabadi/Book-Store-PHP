<?php

session_start();

include('../../config/db.php'); // اتصال به دیتابیس

if(!isset($_SESSION['sellers_id'])){
    die("دسترسی غیرمجاز");
}
$seller_id=$_SESSION['sellers_id'];

if (isset($_GET['id']) ) {
    $id=intval($_GET['id']);
}else{
    die("NOT FOUND");
}

$sql = "SELECT * FROM books WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $book=mysqli_fetch_assoc($result); //اطلاعات مخصول داخل ارایه book

}else{
    die("NOT FOUND");
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
                    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                        <div>
                            <h1>جزییات محصول</h1>
                            <p class="breadcrumbs"><span><a href="index.html">خانه</a></span> <span><i class="mdi mdi-chevron-left"></i></span>محصولات</p>
                        </div>
                        <!-- <div><a href="product-list.html" class="btn btn-primary">ویرایش</a></div> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-default">
                                <div class="card-header card-header-border-bottom">
                                    <h2>جزییات محصول</h2>
                                </div>
                                <div class="card-body product-detail">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6">
                                            <div class="row">
                                                <div class="single-pro-img">
                                                    <div class="single-product-scroll">
                                                        <div class="single-product-cover">
                                                             <div class="single-slide zoom-image-hover"><img class="img-responsive" src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']);?>" alt="<?php echo  htmlspecialchars($book['name']);?>"></div>
                                                          <!--  <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_2.jpg" alt=""></div>
                                                            <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_3.jpg" alt=""></div>
                                                            <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_4.jpg" alt=""></div>
                                                            <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_5.jpg" alt=""></div> -->
                                                        </div>
                                                        <div class="single-nav-thumb">
                                                             <div class="single-slide zoom-image-hover"><img class="img-responsive" src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']);?>" alt="<?php echo  htmlspecialchars($book['name']);?>"></div>
                                                          <!--  <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_2.jpg" alt=""></div>
                                                            <div class="single-slide zoom-image-hover"><img class="img-responsive" src="assets/img/products/pd_3.jpg" alt=""></div>
                                                             <div class="single-slide"><img class="img-responsive" src="assets/img/products/pd_1.jpg" alt=""></div>
                                                            <div class="single-slide"><img class="img-responsive" src="assets/img/products/pd_2.jpg" alt=""></div>
                                                            <div class="single-slide"><img class="img-responsive" src="assets/img/products/pd_3.jpg" alt=""></div>
                                                            <div class="single-slide"><img class="img-responsive" src="assets/img/products/pd_4.jpg" alt=""></div>
                                                            <div class="single-slide"><img class="img-responsive" src="assets/img/products/pd_5.jpg" alt=""></div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-6">
                                            <div class="row product-overview">
                                                <div class="col-12">
                                                    <h5 class="product-title"><?php echo htmlspecialchars($book['name']);?></h5>
                                                    <p class="product-rate"><i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star"></i></p>
                                                    <p class="product-desc"><?php echo htmlspecialchars($book['description']);?> </p>
                                                    <p class="product-desc">
                                                    </p>
                                                    <div class="ec-ofr">
                                                        <h6>دسته بندی:<?php echo htmlspecialchars($book['category']);?></h6>
                                                        <!-- <ul>
                                                            <li><b>قیمت ویژه :</b> بیشتر از  16% تخفیف (قیمت ویژه برای تخفیف) <a href="#">تی اند سی</a></li>
                                                            <li><b>تخفیف بانکی :</b> 10% تخفیف برای دارندگان کارت , تا
                                                                 تومان 12. برای سفارشات بالای 200 تومان <a href="#">تی اند سی</a>
                                                            </li>
                                                            <li><b>تخفیف بانکی :</b> 5% تخفیف با کش بک برای دارندگان حساب اکا <a href="#">تی اند سی</a></li>
                                                            <li><b>تخفیف بانکی :</b>  $50  تخفیف برای اولین خرید بالای 200 تومان <a href="#">تی اند سی</a></li>
                                                        </ul> -->
                                                    </div>
                                                    <p class="product-price">قیمت: <?php echo htmlspecialchars($book['price']);?></p>
                                                    <!-- <p class="product-sku">شناسه#: WH12</p> -->
                                                    <!-- <ul class="product-size">
                                                        <li class="size"><span>S</span></li>
                                                        <li class="size"><span>M</span></li>
                                                        <li class="size"><span>L</span></li>
                                                        <li class="size"><span>XL</span></li>
                                                    </ul> -->
                                                    <!-- <ul class="product-color">
                                                        <li class="color"><span style="background-color:#90cdf7"></span>
                                                        </li>
                                                        <li class="color"><span style="background-color:#ff3b66"></span>
                                                        </li>
                                                        <li class="color"><span style="background-color:#ffc476"></span>
                                                        </li>
                                                        <li class="color"><span style="background-color:#1af0ba"></span>
                                                        </li>
                                                        <li class="color"><span style="background-color:#f887d6"></span>
                                                        </li>
                                                    </ul> -->
                                                    <!-- <div class="product-stock">
                                                        <div class="stock">
                                                            <p class="title">در دسترس</p>
                                                            <p class="text">180</p>
                                                        </div>
                                                        <div class="stock">
                                                            <p class="title"> در انتظار </p>
                                                            <p class="text">50</p>
                                                        </div>
                                                        <div class="stock">
                                                            <p class="title">پیش سفارش</p>
                                                            <p class="text">20</p>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-xl-3 col-lg-12 u-card">
                                            <div class="card card-default seller-card">
                                                <div class="card-body text-center"><a href="javascript:0" class="text-secondary d-inline-block">
                                                        <div class="image mb-3"><img src="assets/img/user/u-xl-4.jpg" class="img-fluid rounded-circle" alt="Avatar Image">
                                                        </div>
                                                        <h5 class="text-dark">جان کارتر</h5>
                                                        <p class="product-rate"><i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star"></i></p>
                                                        <ul class="list-unstyled">
                                                            <li class="d-flex mb-1"><i class="mdi mdi-map mr-1"></i>
                                                                <span>یک آدرس کاملا فرضی.</span></li>
                                                            <li class="d-flex mb-1"><i class="mdi mdi-email mr-1"></i>
                                                                <span><span class="__cf_email__" data-cfemail="d4b1acb5b9a4b8b194b1b9b5bdb8fab7bbb9">john.example@gmail.com</span></span>
                                                            </li>
                                                            <li class="d-flex"><i class="mdi mdi-whatsapp mr-1"></i>
                                                                <span>+00 987-654-3210</span></li>
                                                        </ul>
                                                    </a></div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row review-rating mt-4">
                                        <div class="col-12">
                                            <ul class="nav nav-tabs" id="myRatingTab" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" id="product-detail-tab" data-bs-toggle="tab" data-bs-target="#productdetail" href="#productdetail" role="tab" aria-selected="true"><i class="mdi mdi-library-books mr-1"></i> جزئیات</a></li>
                                                <li class="nav-item"><a class="nav-link" id="product-information-tab" data-bs-toggle="tab" data-bs-target="#productinformation" href="#productinformation" role="tab" aria-selected="false"><i class="mdi mdi-information mr-1"></i>اطلاعات</a></li>
                                                <li class="nav-item"><a class="nav-link" id="product-reviews-tab" data-bs-toggle="tab" data-bs-target="#productreviews" href="#productreviews" role="tab" aria-selected="false"><i class="mdi mdi-star-half mr-1"></i> بررسی ها</a></li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent2">
                                                <div class="tab-pane pt-3 fade show active" id="productdetail" role="tabpanel">
                                                    <ul class="features">
                                                        <li><?php echo htmlspecialchars($book['description']);?></li>
                                                        <!-- <li>محصولات قابل دانلود / دیجیتال، محصولات مجازی</li>
                                                        <li>مدیریت موجودی با موارد خاص</li>
                                                        <li>درز های صاف.</li> -->
                                                    </ul>
                                                </div>
                                                <!-- <div class="tab-pane pt-3 fade" id="productinformation" role="tabpanel">
                                                    <ul>
                                                        <li><span>وزن</span> 1000 گرم</li>
                                                        <li><span>ابعاد</span> 35 × 30 × 7 سانتی متر</li>
                                                        <li><span>رنگ</span> سیاه، صورتی، قرمز، سفید</li>
                                                    </ul>
                                                </div> -->
                                                <div class="tab-pane pt-3 fade" id="productreviews" role="tabpanel">
                                                    <!-- <div class="ec-t-review-wrapper">
                                                        <div class="ec-t-review-item">
                                                            <div class="ec-t-review-avtar"><img src="assets/img/review-image/1.jpg" alt=""></div>
                                                            <div class="ec-t-review-content">
                                                                <div class="ec-t-review-top">
                                                                    <p class="ec-t-review-name">جنی یانل</p>
                                                                    <div class="ec-t-rate"><i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star"></i></div>
                                                                </div>
                                                                <div class="ec-t-review-bottom">
                                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ec-t-review-item">
                                                            <div class="ec-t-review-avtar"><img src="assets/img/review-image/2.jpg" alt=""></div>
                                                            <div class="ec-t-review-content">
                                                                <div class="ec-t-review-top">
                                                                    <p class="ec-t-review-name"> لیندا مورگوس</p>
                                                                    <div class="ec-t-rate"><i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star is-rated"></i> <i class="mdi mdi-star"></i></div>
                                                                </div>
                                                                <div class="ec-t-review-bottom">
                                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است..</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
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
                    <p>&copy; کپی رایت<span>1401</span><a class="text-primary" href="product-detail.html" target="_blank"> داشبرد مدیریتی
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
    <script src="assets/plugins/swiper/swiper-bundle.min.js"></script>
    <script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
    <script src="assets/js/ekka.js"></script>
</body>

</html>