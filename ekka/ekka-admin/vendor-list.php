<?php 
include('../../config/db.php'); // اتصال به دیتابیس
//گرقتن اطلاعات فروشنده ها از حدول 
$sql="SELECT*FROM sellers ORDER BY created_at DESC";
$result=mysqli_query($conn,$sql);
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
    <link href="assets/plugins/data-tables/datatables.bootstrap5.min.css" rel="stylesheet">
    <link href="assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
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
                                    <li class="active"><a class="sidenav-item-link" href="vendor-list.html"><span class="nav-text">لیست فروشندگان</span></a></li>
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
                                        <div class="d-inline-block"> جلال شمس <small class="pt-1"><a class="__cf_email__" data-cfemail="e48e8b8c8aca819c8589948881a48389858d88ca878b89">john.example@gmail.com</a></small>
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
                            <h1>لیست فروشندگان</h1>
                            <p class="breadcrumbs"><span><a href="index.html">خانه</a></span> <span><i class="mdi mdi-chevron-left"></i></span>فروشنده</p>
                        </div>
                        <!-- <div><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVendor"> افزودن فروشنده </button></div> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="ec-vendor-list card card-default">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="responsive-data-table" class="table">
                                            <thead>
                                                <tr>
                                                    <!-- <th>پروفایل</th> -->
                                                    <th>نام</th>
                                                    <th>ایمیل:</th>
                                                    <th>محصولات</th>
                                                    <th>فروش کل</th>
                                                    <th>وضعیت</th>
                                                    <th>پیوستن </th>
                                                    <th>فعالیت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // ==============================
// تابع تبدیل تاریخ میلادی به شمسی
// ورودی: $gy = سال میلادی، $gm = ماه میلادی، $gd = روز میلادی
// خروجی: آرایه شامل [سال شمسی, ماه شمسی, روز شمسی]
// ==============================
function gregorian_to_jalali($gy, $gm, $gd){
    $g_d_m = array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }
    $gy2 = ($gm>2)?($gy+1):$gy;
    $days = 365*$gy + intval(($gy2+3)/4) - intval(($gy2+99)/100) + intval(($gy2+399)/400) - 80 + $gd + $g_d_m[$gm-1];
    $jy += 33*intval($days/12053);
    $days %= 12053;
    $jy += 4*intval($days/1461);
    $days %= 1461;
    if($days > 365){
        $jy += intval(($days-1)/365);
        $days = ($days-1)%365;
    }
    if($days < 186){
        $jm = 1 + intval($days/31);
        $jd = 1 + ($days % 31);
    }else{
        $jm = 7 + intval(($days-186)/30);
        $jd = 1 + (($days-186) % 30);
    }
    return array($jy,$jm,$jd);
}
                                          
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['name']).'</td>';
        echo '<td>'.htmlspecialchars($row['email']).'</td>';
        echo '<td>'.htmlspecialchars($row['total_products']).'</td>';
        echo '<td>'.htmlspecialchars($row['total_sales']).'</td>';
        echo '<td>'.($row['status'] ? 'فعال' : 'غیرفعال').'</td>';
                // گرفتن تاریخ و ساعت میلادی از دیتابیس
$created_at = $row['created_at']; // مثال: '2025-10-26 14:30:00'

// جدا کردن تاریخ و ساعت
list($date, $time) = explode(' ', $created_at); // $date = '2025-10-26', $time = '14:30:00'
list($year, $month, $day) = explode('-', $date);

// تبدیل تاریخ میلادی به شمسی
list($jy, $jm, $jd) = gregorian_to_jalali($year, $month, $day);

// نمایش تاریخ و ساعت شمسی
echo '<td>' . $jd . '/' . $jm . '/' . $jy . ' ' . $time . '</td>';
        echo '<td>
                <a href="vendor-edit.php?id='.$row['id'].'" class="btn btn-sm btn-primary">ویرایش</a>
                <a href="vendor-delete.php?id='.$row['id'].'" class="btn btn-sm btn-danger">حذف</a>
              </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">هیچ فروشنده‌ای موجود نیست</td></tr>';
}
?>
                                                <!-- <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="305d51425c555542555e5170575d51595c1e535f5d">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="dbb1b4b3b5bebeb9b4b7b9b29bbcb6bab2b7f5b8b4b6">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="dfb5b0b7b1bababdb0b3bdb69fb8b2beb6b3f1bcb0b2">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="3954565150575054584b5556795e54585055175a5654">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="d7b9bea3bebbb8bcb6a3bfbebbb897b0bab6bebbf9b4b8ba">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="ea828b988e83998b848e829faa8d878b8386c4898587">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="51333930273d3e3c303d27383011363c30383d7f323e3c">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="cba1aea5a2afbeb8bea1aa8baca6aaa2a7e5a8a4a6">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="7a171b08161f1f081f141b3a1d171b131654191517">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="94fefbfcfaf1f1f6fbf8f6fdd4f3f9f5fdf8baf7fbf9">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="b8d2d7d0d6dddddad7d4dad1f8dfd5d9d1d496dbd7d5">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="8ee3e1e6e7e0e7e3effce2e1cee9e3efe7e2a0ede1e3">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="d6b8bfa2bfbab9bdb7a2bebfbab996b1bbb7bfbaf8b5b9bb">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="1e767f6c7a776d7f707a766b5e79737f7772307d7173">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="dcbeb4bdaab0b3b1bdb0aab5bd9cbbb1bdb5b0f2bfb3b1">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="e78d82898e839294928d86a7808a868e8bc984888a">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="0c616d7e6069697e69626d4c6b616d6560226f6361">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="0c6663646269696e63606e654c6b616d6560226f6361">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="38525750565d5d5a57545a51785f55595154165b5755">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="ef828087868186828e9d8380af88828e8683c18c8082">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="c8a6a1bca1a4a7a3a9bca0a1a4a788afa5a9a1a4e6aba7a5">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="533b3221373a20323d373b2613343e323a3f7d303c3e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="03616b62756f6c6e626f756a6243646e626a6f2d606c6e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="aec4cbc0c7cadbdddbc4cfeec9c3cfc7c280cdc1c3">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                                <!-- <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="bed3dfccd2dbdbccdbd0dffed9d3dfd7d290ddd1d3">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="fc9693949299999e93909e95bc9b919d9590d29f9391">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="87ede8efe9e2e2e5e8ebe5eec7e0eae6eeeba9e4e8ea">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="234e4c4b4a4d4a4e42514f4c63444e424a4f0d404c4e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="630d0a170a0f0c0802170b0a0f0c23040e020a0f4d000c0e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="21494053454852404f45495461464c40484d0f424e4c">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="07656f66716b686a666b716e6647606a666e6b2964686a">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="94fef1fafdf0e1e7e1fef5d4f3f9f5fdf8baf7fbf9">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="fd909c8f9198988f98939cbd9a909c9491d39e9290">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="e68c898e88838384898a848fa6818b878f8ac885898b">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="cda7a2a5a3a8a8afa2a1afa48daaa0aca4a1e3aea2a0">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="d4b9bbbcbdbabdb9b5a6b8bb94b3b9b5bdb8fab7bbb9">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="d0beb9a4b9bcbfbbb1a4b8b9bcbf90b7bdb1b9bcfeb3bfbd">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="1e767f6c7a776d7f707a766b5e79737f7772307d7173">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="9ffdf7fee9f3f0f2fef3e9f6fedff8f2fef6f3b1fcf0f2">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="4b212e25222f3e383e212a0b2c262a222765282426">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="b3ded2c1dfd6d6c1d6ddd2f3d4ded2dadf9dd0dcde">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="573d383f39323235383b353e17303a363e3b7934383a">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="d9b3b6b1b7bcbcbbb6b5bbb099beb4b8b0b5f7bab6b4">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="89e4e6e1e0e7e0e4e8fbe5e6c9eee4e8e0e5a7eae6e4">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="76181f021f1a191d17021e1f1a1936111b171f1a5815191b">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="b6ded7c4d2dfc5d7d8d2dec3f6d1dbd7dfda98d5d9db">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="70121811061c1f1d111c06191130171d11191c5e131f1d">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="82e8e7ecebe6f7f1f7e8e3c2e5efe3ebeeace1edef">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="c2afa3b0aea7a7b0a7aca382a5afa3abaeeca1adaf">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="a9c3c6c1c7cccccbc6c5cbc0e9cec4c8c0c587cac6c4">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="711b1e191f1414131e1d131831161c10181d5f121e1c">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="8ae7e5e2e3e4e3e7ebf8e6e5caede7ebe3e6a4e9e5e7">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="fc929588959093979d8894959093bc9b919d9590d29f9391">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="741c1506101d07151a101c01341319151d185a171b19">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="395b51584f55565458554f5058795e54585055175a5654">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="bad0dfd4d3decfc9cfd0dbfaddd7dbd3d694d9d5d7">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="701d11021c151502151e1130171d11191c5e131f1d">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="c0aaafa8aea5a5a2afaca2a980a7ada1a9aceea3afad">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="ddb7b2b5b3b8b8bfb2b1bfb49dbab0bcb4b1f3beb2b0">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="d4b9bbbcbdbabdb9b5a6b8bb94b3b9b5bdb8fab7bbb9">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="e18f8895888d8e8a809589888d8ea1868c80888dcf828e8c">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="e48c8596808d97858a808c91a48389858d88ca878b89">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="680a00091e04070509041e0109280f05090104460b0705">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="deb4bbb0b7baabadabb4bf9eb9b3bfb7b2f0bdb1b3">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="cba6aab9a7aeaeb9aea5aa8baca6aaa2a7e5a8a4a6">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="355f5a5d5b5050575a59575c755258545c591b565a58">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="b2d8dddadcd7d7d0ddded0dbf2d5dfd3dbde9cd1dddf">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="9bf6f4f3f2f5f2f6fae9f7f4dbfcf6faf2f7b5f8f4f6">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="533d3a273a3f3c3832273b3a3f3c13343e323a3f7d303c3e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="523a3320363b21333c363a2712353f333b3e7c313d3f">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="e6848e87908a898b878a908f87a6818b878f8ac885898b">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="066c63686f627375736c6746616b676f6a2865696b">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="a9c4c8dbc5ccccdbccc7c8e9cec4c8c0c587cac6c4">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="c0aaafa8aea5a5a2afaca2a980a7ada1a9aceea3afad">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="90fafff8fef5f5f2fffcf2f9d0f7fdf1f9fcbef3fffd">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="1f727077767176727e6d73705f78727e7673317c7072">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="76181f021f1a191d17021e1f1a1936111b171f1a5815191b">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="a1c9c0d3c5c8d2c0cfc5c9d4e1c6ccc0c8cd8fc2cecc">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="385a50594e54575559544e5159785f55595154165b5755">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="a9c3ccc7c0cddcdadcc3c8e9cec4c8c0c587cac6c4">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="vendor image"></td>
                                                    <td>مارلی رنا</td>
                                                    <td><a class="__cf_email__" data-cfemail="137e72617f767661767d7253747e727a7f3d707c7e">john.example@gmail.com</a>
                                                    </td>
                                                    <td>28</td>
                                                    <td>2161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-30</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u2.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="c2a8adaaaca7a7a0adaea0ab82a5afa3abaeeca1adaf">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u3.jpg" alt="vendor image"></td>
                                                    <td>جانی بابلی</td>
                                                    <td><a class="__cf_email__" data-cfemail="a6ccc9cec8c3c3c4c9cac4cfe6c1cbc7cfca88c5c9cb">john.example@gmail.com</a>
                                                    </td>
                                                    <td>68</td>
                                                    <td>5161</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-25</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u4.jpg" alt="vendor image"></td>
                                                    <td>موهینی مارلو</td>
                                                    <td><a class="__cf_email__" data-cfemail="87eae8efeee9eeeae6f5ebe8c7e0eae6eeeba9e4e8ea">john.example@gmail.com</a>
                                                    </td>
                                                    <td>38</td>
                                                    <td>1561</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-21</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u5.jpg" alt="vendor image"></td>
                                                    <td>نیتیلو کاتا</td>
                                                    <td><a class="__cf_email__" data-cfemail="fb95928f929794909a8f93929794bb9c969a9297d5989496">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>1061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-18</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u6.jpg" alt="vendor image"></td>
                                                    <td>هاردی ساند</td>
                                                    <td><a class="__cf_email__" data-cfemail="60080112040913010e04081520070d01090c4e030f0d">john.example@gmail.com</a>
                                                    </td>
                                                    <td>82</td>
                                                    <td>10061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-14</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u7.jpg" alt="vendor image"></td>
                                                    <td>باهولا مالیو</td>
                                                    <td><a class="__cf_email__" data-cfemail="f89a90998e94979599948e9199b89f95999194d69b9795">john.example@gmail.com</a>
                                                    </td>
                                                    <td>18</td>
                                                    <td>3061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-05</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img class="vendor-thumb" src="assets/img/vendor/u8.jpg" alt="vendor image"></td>
                                                    <td>جنی داستو</td>
                                                    <td><a class="__cf_email__" data-cfemail="bbd1ded5d2dfcec8ced1dafbdcd6dad2d795d8d4d6">john.example@gmail.com</a>
                                                    </td>
                                                    <td>60</td>
                                                    <td>6061</td>
                                                    <td>فعال</td>
                                                    <td>1401-10-01</td>
                                                    <td>
                                                        <div class="btn-group"><button type="button" class="btn btn-outline-success">اطلاعات</button> <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">اطلاعات</span></button>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="#">ویرایش</a> <a class="dropdown-item" href="#">حذف</a></div>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-add-contact" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <form>
                                    <div class="modal-header px-4">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">فروشنده جدید اضافه کنید</h5>
                                    </div>
                                    <div class="modal-body px-4">
                                        <div class="form-group row mb-6"><label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">تصویر فروشنده</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="custom-file mb-1"><input type="file" class="custom-file-input" id="coverImage" required=""><label class="custom-file-label" for="coverImage"> انتخاب پرونده ... </label>
                                                    <div class="invalid-feedback" مثال="" بازخورد="" پرونده="" سفارشی="" نامعتبر="" است=""></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-6">
                                                <div class="form-group"><label for="firstName">نام</label><input class="form-control" id="firstName" value="جان"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group"><label for="lastName"> نام خانوادگی </label><input class="form-control" id="lastName" value="دویی"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4"><label for="userName">نام کاربری</label><input class="form-control" id="userName" value="johndoe"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4"><label for="email">ایمیل:</label><input type="email" class="form-control" id="email" value="johnexample@gmail.com"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4"><label for="Birthday"> تاریخ تولد</label><input class="form-control" id="Birthday" value="10-12-1401"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-4"><label for="event">آدرس </label><input class="form-control" id="event" value="آدرس در اینجا"></div>
                                            </div>
                                        </div>
                                    </form></div>
                                    <div class="modal-footer px-4"><button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">لغو</button>
                                        <button type="button" class="btn btn-primary btn-pill">ذخیره </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>&copy;  کپی رایت  <span>1401</span><a class="text-primary" href="vendor-list.html" target="_blank"> داشبرد مدیریتی اکا </a>.
                       همه حقوق محفوظ است.</p>
                </div>
            </footer>
        </div>
    
    <script data-cfasync="false" src="assets/plugins/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery.notify.min.js"></script>
    <script src="assets/plugins/jquery/jquery.bundle.notify.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/simplebar/simplebar.min.js"></script>
    <script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    <script src="assets/plugins/slick/slick.min.js"></script>
    <script src="assets/plugins/data-tables/jquery.datatables.min.js"></script>
    <script src="assets/plugins/data-tables/datatables.bootstrap5.min.js"></script>
    <script src="assets/plugins/data-tables/datatables.responsive.min.js"></script>
    <script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
    <script src="assets/js/ekka.js"></script>
</body>

</html>