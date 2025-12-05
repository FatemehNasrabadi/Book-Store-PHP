<?php
session_start();

include('../../config/db.php'); // اتصال به دیتابیس

//عدد سبد خرید
$cart_count=0;
if(isset($_SESSION['cart'])&& is_array($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $qty){
        $cart_count+=$qty;
    }
}

// گرفتن دسته‌بندی از URL
$category = isset($_GET['category']) ? trim($_GET['category']) : null;

// اگر دسته‌بندی مشخص شده باشه، فقط همون دسته رو بگیر
if ($category) {
    $category_safe = mysqli_real_escape_string($conn, $category);
    $sql = "SELECT * FROM books WHERE category='$category_safe' ORDER BY created_at DESC";
} else {
    // اگر دسته‌بندی مشخص نشده باشه، همه کتاب‌ها رو بگیر
    $sql = "SELECT * FROM books ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>





<!--========================================================= 
    Item Name: Ekka - Ecommerce HTML Template.
    Author: ashishmaraviya
    Version: 1.0
    Copyright 2021-2022
	Author URI: https://themeforest.net/user/ashishmaraviya
 ============================================================-->
<!DOCTYPE html>
<html lang="en">

  <!-- جاوا اسکریبپت برای اپدیت بدون رفرش -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('.add-to-cart-btn').click(function(e){
    e.preventDefault();
    var bookId = $(this).data('id');
    $.get('add_to_cart.php', {id: bookId}, function(){
        // بعد از افزودن محصول، عدد سبد را آپدیت کن
        var count = parseInt($('#cart-count').text());
        $('#cart-count').text(count + 1);
    });
});
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>اکا- قالب اچ تی ام ال ووکامرس</title>
    <meta name="keywords"
        content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops">
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">

    <!-- site Favicon -->
    <link rel="icon" href="assets/images/favicon/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon.png">
    <meta name="msapplication-TileImage" content="assets/images/favicon/favicon.png">

    <!-- css Icon Font -->
    <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css">

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css">
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider.css">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.css">

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rtl.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">

</head>

<body class="shop_page">
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    <header class="ec-header">
        <!--Ec Header Top Start -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Top social Start -->
                    <div class="col text-left header-top-left d-none d-lg-block">
                        <!-- <div class="header-top-social">
                            <span class="social-text text-upper">ما را دنبال کنید در:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                            class="ecicon eci-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                            class="ecicon eci-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                            class="ecicon eci-instagram"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                            class="ecicon eci-linkedin"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                    <!-- Header Top social End -->
                    <!-- Header Top Message Start -->
           
                    <!-- Header Top Message End -->
                    <!-- Header Top Language Currency -->
                   
                    <!-- Header Top Language Currency -->
                    <!-- Header Top responsive Action -->
                    <div class="col d-lg-none ">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="assets/images/icons/user.svg" class="svg_img header_svg" alt=""></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="register.html">ثبت نام</a></li>
                                    <li><a class="dropdown-item" href="user-profile.html">پروفایل کاربر</a></li>
                                    <li><a class="dropdown-item" href="login.html">ورود</a></li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <!-- <a href="wishlist.html" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                        class="svg_img header_svg" alt=""></div>
                                <span class="ec-header-count">4</span>
                            </a> -->
                            <!-- Header Cart End -->
                            <!-- Header Cart Start -->
                          <a href="cart.php" class="ec-header-btn ">
                                    <div class="header-icon"><img src="assets/images/icons/cart.svg"
                                            class="svg_img header_svg" alt="" /></div>
                                    <span  id="cart-count" class="ec-header-count ec-cart-count"><?php echo isset($_SESSION['cart'])?array_sum($_SESSION['cart']):0;?></span><span class="ec-btn-title">سبد
                                        خرید</span>
                                </a>
                            <!-- Header Cart End -->
                            <!-- Header menu Start -->
                            <!-- <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                                <img src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon">
                            </a> -->
                            <!-- Header menu End -->
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <!-- <div class="align-self-center">
                            <div class="header-logo">
                                <a href="index.html"><img src="assets/images/logo/logo.png" alt="لوگو سایت"><img
                                        class="dark-logo" src="assets/images/logo/dark-logo.png" alt="لوگو سایت"
                                        style="display: none;"></a>
                            </div>
                        </div> -->
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">
                            <div class="header-search">
                                <form class="ec-btn-group-form" action="search.php" method="GET">
                                    <input class="form-control" placeholder="نام محصول خود را وارد کنید ..."
                                        type="text" name="q" required/>
                                    <button class="submit" type="submit"><img src="assets/images/icons/search.svg"
                                            class="svg_img header_svg" alt=""><i class="ecicon eci-search"></i></button>
                                </form>
                                
                            </div>
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                            src="assets/images/icons/user.svg" class="svg_img header_svg"
                                            alt=""></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="register.html">ثبت نام</a></li>
                                        <li><a class="dropdown-item" href="user-profile.html">پروفایل کاربر</a></li>
                                        <li><a class="dropdown-item" href="login.html">ورود</a></li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                                <!-- Header wishlist Start -->
                                <!-- <a href="wishlist.html" class="ec-header-btn ec-header-wishlist">
                                    <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                            class="svg_img header_svg" alt=""></div>
                                    <span class="ec-header-count">4</span>
                                </a> -->
                                <!-- Header wishlist End -->
                                <!-- Header Cart Start -->
                                  <a href="cart.php" class="ec-header-btn ">
                                    <div class="header-icon"><img src="assets/images/icons/cart.svg"
                                            class="svg_img header_svg" alt="" /></div>
                                    <span  id="cart-count" class="ec-header-count ec-cart-count"><?php echo isset($_SESSION['cart'])?array_sum($_SESSION['cart']):0;?></span><span class="ec-btn-title">سبد
                                        خرید</span>  
                                </a>
                              
                                <!-- Header Cart End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row ">

                    <!-- Ec Header Logo Start -->
                    <div class="col">
                        <div class="header-logo">
                            <a href="index.html"><img src="assets/images/logo/logo.png" alt="لوگو سایت"><img
                                    class="dark-logo" src="assets/images/logo/dark-logo.png" alt="لوگو سایت"
                                    style="display: none;"></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    <div class="col">
                        <div class="header-search">
                              <form class="ec-search-group-form" action="search.php" method="GET">
                                    <input class="form-control" placeholder="جستجو ..." type="text" name="q" required/>
                                    <button class="search_submit" type="submit">جستجو<img
                                            src="assets/images/icons/search.svg" class="svg_img search_svg"
                                            alt="" /> <i class="ecicon eci-search"></i> </button>
                                </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->
        <!-- EC Main Menu Start -->
        <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="ec-main-menu">
                            
                            <ul>
                                <li><a href="index.html">خانه</a></li>
                                <li class="dropdown position-static"><a href="javascript:void(0)">دسته بندی ها</a>
                                    <ul class="mega-menu d-block">
                                        <li class="d-flex">
                                             <!-- <ul class="d-block">
                                                
                                                <li><a href="shop-left-sidebar-col-3.php"> همه محصولات</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=رمان"> رمان</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=کودک">کودک</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=زبان انگلیسی"> زبان انگلیسی</a></li>
                                            </ul> -->
                                            <ul class="d-block">
                                                
                                                <li><a href="shop-left-sidebar-col-3.php"> همه محصولات</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=رمان"> رمان</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=کودک">کودک</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=زبان انگلیسی"> زبان انگلیسی</a></li>
                                            </ul>
                                           
                                    </ul>
                                </li>
                                <!-- <li class="dropdown"><a href="javascript:void(0)">محصولات</a>
                                    <ul class="sub-menu">
                                        <li class="dropdown position-static"><a href="javascript:void(0)">صفحه محصولات
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-left-sidebar.html">محصول سایدبار چپ</a></li>
                                                <li><a href="product-right-sidebar.html">محصول سایدبار راست</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">محصول 360 درجه
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-360-left-sidebar.html">360 ساید بار چپ</a></li>
                                                <li><a href="product-360-right-sidebar.html">360 ساید بار راست</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">محصول ویدئویی
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-video-left-sidebar.html">سایدبار چپ ویدئویی</a>
                                                </li>
                                                <li><a href="product-video-right-sidebar.html">سایدبار راست ویدئویی</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">گالری محصول
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-gallery-left-sidebar.html">سایدبار چپ گالری</a>
                                                </li>
                                                <li><a href="product-gallery-right-sidebar.html">سایدبار راست گالری</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="product-full-width.html">محصول تمام عرض</a></li>
                                        <li><a href="product-360-full-width.html">360 تمام عرض</a></li>
                                        <li><a href="product-video-full-width.html">تمام عرض ویدئو </a></li>
                                        <li><a href="product-gallery-full-width.html">تمام عرض گالری</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:void(0)">صفحات</a>
                                    <ul class="sub-menu">
                                        <li><a href="about-us.html">درباره ما</a></li>
                                        <li><a href="contact-us.html">ارتباط با ما</a></li>
                                        <li><a href="cart.html">سبد خرید</a></li>
                                        <li><a href="checkout.html">ادامه خرید</a></li>
                                        <li><a href="compare.html">مقایسه</a></li>
                                        <li><a href="faq.html">سوالات متداول</a></li>
                                        <li><a href="login.html">ورود</a></li>
                                        <li><a href="register.html">ثبت نام</a></li>
                                        <li><a href="track-order.html">پیگیری سفارش</a></li>
                                        <li><a href="terms-condition.html">شرایط و ضوابط</a></li>
                                        <li><a href="privacy-policy.html">سیاست حفظ حریم خصوصی</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><span class="main-label-note-new" data-toggle="tooltip"
                                        title="NEW"></span><a href="javascript:void(0)">دیگر</a>
                                    <ul class="sub-menu">
                                        <li class="dropdown position-static"><a href="javascript:void(0)">تاییده ایمیل
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="email-template-confirm-1.html">تاییده ایمیل 1</a></li>
                                                <li><a href="email-template-confirm-2.html">تاییده ایمیل 2</a></li>
                                                <li><a href="email-template-confirm-3.html">تاییده ایمیل 3</a></li>
                                                <li><a href="email-template-confirm-4.html">تاییده ایمیل 4</a></li>
                                                <li><a href="email-template-confirm-5.html">تاییده ایمیل 5</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">ایمیل ریست
                                                رمزعبور
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="email-template-forgot-password-1.html">ایمیل ریست رمزعبور
                                                        1</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-2.html">ایمیل ریست رمزعبور
                                                        2</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-3.html">ایمیل ریست رمزعبور
                                                        3</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-4.html">ایمیل ریست رمزعبور
                                                        4</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-5.html">ایمیل ریست رمزعبور
                                                        5</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">ایمیل تبلیغاتی
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="email-template-offers-1.html">ایمیل تبلیغاتی 1</a></li>
                                                <li><a href="email-template-offers-2.html">ایمیل تبلیغاتی 2</a></li>
                                                <li><a href="email-template-offers-3.html">ایمیل تبلیغاتی 3</a></li>
                                                <li><a href="email-template-offers-4.html">ایمیل تبلیغاتی 4</a></li>
                                                <li><a href="email-template-offers-5.html">ایمیل تبلیغاتی 5</a></li>
                                                <li><a href="email-template-offers-6.html">ایمیل تبلیغاتی 6</a></li>
                                                <li><a href="email-template-offers-7.html">ایمیل تبلیغاتی 7</a></li>
                                                <li><a href="email-template-offers-8.html">ایمیل تبلیغاتی 8</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static">
                                            <span class="label-note-hot"></span>
                                            <a href="javascript:void(0)">صفحات اکانت فروشنده
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="vendor-dashboard.html">داشبرد فروشنده</a></li>
                                                <li><a href="vendor-profile.html">پروفایل فروشنده</a></li>
                                                <li><a href="vendor-uploads.html">آپلودهای فروشنده</a></li>
                                                <li><a href="vendor-settings.html">تنظیمات فروشنده</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static">
                                            <span class="label-note-trending"></span>
                                            <a href="javascript:void(0)">صفحات اکانت کاربر
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="user-profile.html">پروفایل کاربر</a></li>
                                                <li><a href="user-history.html">تاریخچه</a></li>
                                                <li><a href="wishlist.html">علاقه مندی ها</a></li>
                                                <li><a href="track-order.html">پیگیری سفارش</a></li>
                                                <li><a href="user-invoice.html">فاکتور</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)">صفحات ساخت و
                                                ساز
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="404-error-page.html">404 صفحه خطا</a></li>
                                                <li><a href="under-maintenance.html">صفحه در حال ساخت</a></li>
                                                <li><a href="coming-soon.html">صفحه به زودی</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static">
                                            <span class="label-note-new"></span>
                                            <a href="javascript:void(0)">صفحات کاتالوگ فروشندگی
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="catalog-single-vendor.html">کاتالوگ تک فروشنده </a></li>
                                                <li><a href="catalog-multi-vendor.html">کاتالوگ چند فروشنده </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:void(0)">بلاگ</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-left-sidebar.html">بلاگ سایدبار چپ</a></li>
                                        <li><a href="blog-right-sidebar.html">بلاگ سایدبار راست</a></li>
                                        <li><a href="blog-detail-left-sidebar.html">جزییات بلاگ سایدبار چپ</a></li>
                                        <li><a href="blog-detail-right-sidebar.html">جزییات بلاگ سایدبار راست</a></li>
                                        <li><a href="blog-full-width.html">بلاگ تمام عرض</a></li>
                                        <li><a href="blog-detail-full-width.html">جزییات بلاگ تمام عرض</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:void(0)">عناصر</a>
                                    <ul class="sub-menu">
                                        <li><a href="elemets-products.html">محصولات</a></li>
                                        <li><a href="elemets-typography.html">تایپوگرافی</a></li>
                                        <li><a href="elemets-title.html">سرتیترها</a></li>
                                        <li><a href="elemets-categories.html">دسته بندی ها</a></li>
                                        <li><a href="elemets-buttons.html">دکمه ها</a></li>
                                        <li><a href="elemets-tabs.html">تب ها</a></li>
                                        <li><a href="elemets-accordions.html">آکاردیون</a></li>
                                        <li><a href="elemets-blog.html">بلاگ</a></li>
                                    </ul>
                                </li>
                                <li><a href="offer.html">پیشنهادات داغ</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Main Menu End -->
        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">منو</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="index.html">خانه</a></li>
                        <li><a href="javascript:void(0)">دسته بندی ها</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0)">ورژن کلاسیک</a>
                                    <ul class="sub-menu">
                                       <li><a href="shop-left-sidebar-col-3.php"> همه محصولات</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=رمان"> رمان</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=کودک">کودک</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=زبان انگلیسی"> زبان انگلیسی</a></li>
                                    </ul>
                                </li>
                                <!-- <li>
                                    <a href="javascript:void(0)">ورژن کلاسیک</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-banner-left-sidebar-col-3.html"> بنر سایدبار چپ 3
                                                column</a></li>
                                        <li><a href="shop-banner-left-sidebar-col-4.html"> بنر سایدبار چپ 4
                                                column</a></li>
                                        <li><a href="shop-banner-right-sidebar-col-3.html"> بنر سایدبار راست 3
                                                column</a></li>
                                        <li><a href="shop-banner-right-sidebar-col-4.html"> بنر سایدبار راست 4
                                                column</a></li>
                                        <li><a href="shop-banner-full-width.html"> بنر تمام عرض 4 ستونه</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ورژن ستونه</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-full-width-col-3.html">3 ستون تمام عرض</a></li>
                                        <li><a href="shop-full-width-col-4.html">4 ستون تمام عرض</a></li>
                                        <li><a href="shop-full-width-col-5.html">5 ستون تمام عرض</a></li>
                                        <li><a href="shop-full-width-col-6.html">6 ستون تمام عرض</a></li>
                                        <li><a href="shop-banner-full-width-col-3.html">بنر 3 ستونه</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ورژن لیست</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-list-left-sidebar.html">فروشگاه با سایدبار چپ</a></li>
                                        <li><a href="shop-list-right-sidebar.html">فروشگاه با سایدبار راست</a></li>
                                        <li><a href="shop-list-banner-left-sidebar.html"> بنر سایدبار چپ </a></li>
                                        <li><a href="shop-list-banner-right-sidebar.html"> بنر سایدبار راست </a></li>
                                        <li><a href="shop-list-full-col-2.html">تمام عرض 2 ستونه</a></li>
                                    </ul>
                                </li>
                                <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img class="img-responsive"
                                            src="assets/images/menu-banner/1.jpg" alt=""></a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- <li><a href="javascript:void(0)">محصولات</a>
                            <ul class="sub-menu">
                                <li><a href="javascript:void(0)">صفحه محصولات</a>
                                    <ul class="sub-menu">
                                        <li><a href="product-left-sidebar.html">محصول سایدبار چپ</a></li>
                                        <li><a href="product-right-sidebar.html">محصول سایدبار راست</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">محصول 360 درجه</a>
                                    <ul class="sub-menu">
                                        <li><a href="product-360-left-sidebar.html">360 ساید بار چپ</a></li>
                                        <li><a href="product-360-right-sidebar.html">360 ساید بار راست</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">محصول ویدئو</a>
                                    <ul class="sub-menu">
                                        <li><a href="product-video-left-sidebar.html">سایدبار چپ ویدئویی</a></li>
                                        <li><a href="product-video-right-sidebar.html">سایدبار راست ویدئویی</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">محصول گالری</a>
                                    <ul class="sub-menu">
                                        <li><a href="product-gallery-left-sidebar.html">سایدبار چپ گالری</a></li>
                                        <li><a href="product-gallery-right-sidebar.html">سایدبار راست گالری</a></li>
                                    </ul>
                                </li>
                                <li><a href="product-full-width.html">محصول تمام عرض</a></li>
                                <li><a href="product-360-full-width.html">360 تمام عرض</a></li>
                                <li><a href="product-video-full-width.html">تمام عرض ویدئو </a></li>
                                <li><a href="product-gallery-full-width.html">تمام عرض گالری</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">دیگر</a>
                            <ul class="sub-menu">
                                <li><a href="javascript:void(0)">تاییده ایمیل </a>
                                    <ul class="sub-menu">
                                        <li><a href="email-template-confirm-1.html">تاییده ایمیل 1</a></li>
                                        <li><a href="email-template-confirm-2.html">تاییده ایمیل 2</a></li>
                                        <li><a href="email-template-confirm-3.html">تاییده ایمیل 3</a></li>
                                        <li><a href="email-template-confirm-4.html">تاییده ایمیل 4</a></li>
                                        <li><a href="email-template-confirm-5.html">تاییده ایمیل 5</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">ایمیل فراموشی رمز عبور</a>
                                    <ul class="sub-menu">
                                        <li><a href="email-template-forgot-password-1.html">ایمیل ریست رمزعبور 1</a>
                                        </li>
                                        <li><a href="email-template-forgot-password-2.html">ایمیل ریست رمزعبور 2</a>
                                        </li>
                                        <li><a href="email-template-forgot-password-3.html">ایمیل ریست رمزعبور 3</a>
                                        </li>
                                        <li><a href="email-template-forgot-password-4.html">ایمیل ریست رمزعبور 4</a>
                                        </li>
                                        <li><a href="email-template-forgot-password-5.html">ایمیل ریست رمزعبور 5</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">ایمیل تبلیغاتی</a>
                                    <ul class="sub-menu">
                                        <li><a href="email-template-offers-1.html">ایمیل تبلیغاتی 1</a></li>
                                        <li><a href="email-template-offers-2.html">ایمیل تبلیغاتی 2</a></li>
                                        <li><a href="email-template-offers-3.html">ایمیل تبلیغاتی 3</a></li>
                                        <li><a href="email-template-offers-4.html">ایمیل تبلیغاتی 4</a></li>
                                        <li><a href="email-template-offers-5.html">ایمیل تبلیغاتی 5</a></li>
                                        <li><a href="email-template-offers-6.html">ایمیل تبلیغاتی 6</a></li>
                                        <li><a href="email-template-offers-7.html">ایمیل تبلیغاتی 7</a></li>
                                        <li><a href="email-template-offers-8.html">ایمیل تبلیغاتی 8</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">صفحات اکانت فروشنده</a>
                                    <ul class="sub-menu">
                                        <li><a href="vendor-dashboard.html">داشبرد فروشنده</a></li>
                                        <li><a href="vendor-profile.html">پروفایل فروشنده</a></li>
                                        <li><a href="vendor-uploads.html">آپلودهای فروشنده</a></li>
                                        <li><a href="vendor-settings.html">تنظیمات فروشنده</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">صفحات اکانت کاربر</a>
                                    <ul class="sub-menu">
                                        <li><a href="user-profile.html">پروفایل کاربر</a></li>
                                        <li><a href="user-history.html">تاریخچه کاربر</a></li>
                                        <li><a href="wishlist.html">علاقه مندی ها</a></li>
                                        <li><a href="track-order.html">پیگیری سفارش</a></li>
                                        <li><a href="user-invoice.html">فاکتور کاربر</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">صفحات ساخت و ساز</a>
                                    <ul class="sub-menu">
                                        <li><a href="404-error-page.html">404 صفحه خطا</a></li>
                                        <li><a href="under-maintenance.html">صفحه در حال ساخت</a></li>
                                        <li><a href="coming-soon.html">صفحه به زودی</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">صفحات کاتالوگ فروشندگی</a>
                                    <ul class="sub-menu">
                                        <li><a href="catalog-single-vendor.html">کاتالوگ تک فروشنده </a></li>
                                        <li><a href="catalog-multi-vendor.html">کاتالوگ چند فروشنده </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">صفحات</a>
                            <ul class="sub-menu">
                                <li><a href="about-us.html">درباره ما</a></li>
                                <li><a href="contact-us.html">ارتباط با ما</a></li>
                                <li><a href="cart.html">سبد خرید</a></li>
                                <li><a href="checkout.html">ادامه خرید</a></li>
                                <li><a href="compare.html">مقایسه</a></li>
                                <li><a href="faq.html">سوالات متداول</a></li>
                                <li><a href="login.html">ورود</a></li>
                                <li><a href="register.html">ثبت نام</a></li>
                                <li><a href="track-order.html">پیگیری سفارش</a></li>
                                <li><a href="terms-condition.html">شرایط و ضوابط</a></li>
                                <li><a href="privacy-policy.html">سیاست حفظ حریم خصوصی</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">بلاگ</a>
                            <ul class="sub-menu">
                                <li><a href="blog-left-sidebar.html">بلاگ سایدبار چپ</a></li>
                                <li><a href="blog-right-sidebar.html">بلاگ سایدبار راست</a></li>
                                <li><a href="blog-detail-left-sidebar.html">جزییات بلاگ سایدبار چپ</a></li>
                                <li><a href="blog-detail-right-sidebar.html">جزییات بلاگ سایدبار راست</a></li>
                                <li><a href="blog-full-width.html">بلاگ تمام عرض</a></li>
                                <li><a href="blog-detail-full-width.html">جزییات بلاگ تمام عرض</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">عناصر</a>
                            <ul class="sub-menu">
                                <li><a href="elemets-products.html">محصولات</a></li>
                                <li><a href="elemets-typography.html">تایپوگرافی</a></li>
                                <li><a href="elemets-title.html">سرتیترها</a></li>
                                <li><a href="elemets-categories.html">دسته بندی ها</a></li>
                                <li><a href="elemets-buttons.html">دکمه ها</a></li>
                                <li><a href="elemets-tabs.html">تب ها</a></li>
                                <li><a href="elemets-accordions.html">آکاردیون</a></li>
                                <li><a href="elemets-blog.html">بلاگ</a></li>
                            </ul>
                        </li>
                        <li><a href="offer.html">پیشنهادات داغ</a></li> -->
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <div class="header-top-lan-curr">
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">زبان<i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">انگلیسی</a></li>
                                <li><a class="dropdown-item" href="#">ایتالیایی</a></li>
                            </ul>
                        </div>
                        <!-- Language End -->
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">ارز<i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">دلار</a></li>
                                <li><a class="dropdown-item" href="#">یورو</a></li>
                            </ul>
                        </div>
                        <!-- Currency End -->
                    </div>
                    <!-- Social Start -->
                    <div class="header-res-social">
                        <div class="header-top-social">
                            <ul class="mb-0">
                                <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                            class="ecicon eci-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                            class="ecicon eci-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                            class="ecicon eci-instagram"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                            class="ecicon eci-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>
    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <!-- <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">سبد خرید من</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="assets/images/product-image/6_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">تی شرت برای زنان</a>
                            <span class="cart-price"><span>7600 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="assets/images/product-image/12_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">کفش چرمی زنانه</a>
                            <span class="cart-price"><span>6400 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                src="assets/images/product-image/3_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">کیف دخترانه نیلون</a>
                            <span class="cart-price"><span>5900 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                            </div>
                            <a href="javascript:void(0)" class="remove">×</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-ریزهزینه">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-left">ریز هزینه:</td>
                                <td class="text-right">3000 تومان</td>
                            </tr>
                            <tr>
                                <td class="text-left">مالیات (20%) :</td>
                                <td class="text-right">6000 تومان</td>
                            </tr>
                            <tr>
                                <td class="text-left">جمع کل:</td>
                                <td class="text-right primary-color">3600 تومان</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_btn">
                    <a href="cart.html" class="btn btn-primary">مشاهده سبد خرید</a>
                    <a href="checkout.html" class="btn btn-secondary">ادامه خرید</a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- ekka Cart End -->

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">فروشگاه</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.html">خانه</a></li>
                                <li class="ec-breadcrumb-item active">فروشگاه</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Shop page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-9 order-lg-last col-md-12 order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    
                    
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->

                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                        <style>
                            .product-info {
    text-align: center; /* متن وسط کارت */
    margin-top: 30px;   /* فاصله از تصویر */
}

.product-info .product-name {
    font-size: 16px;    /* سایز مناسب اسم */
    font-weight: 600;   /* کمی ضخیم */
    color: #333;        /* رنگ متن */
    margin-bottom: 5px; /* فاصله پایین اسم تا قیمت */
    line-height: 1.2;   /* فاصله بین خطوط در صورت طولانی بودن اسم */
}

.product-info .price {
    font-size: 15px;
    color: #ff5722;     /* رنگ نارنجی برای قیمت */
    font-weight: bold;
    display: block;
}
                        </style>
                           <?php
if(mysqli_num_rows($result) > 0) {
    echo '<div class="row">'; // والد کارت‌ها
    
    while($row = mysqli_fetch_assoc($result)) { 
        ?>
        <div class="col-6 col-sm-4 col-md-3 mn-4 col-md-4 col-lg-3 mb-4 pro-gl-content">
            <div class="ec-product-inner">
                <div class="ec-pro-image-outer">
                    <div class="ec-pro-image">
                        <a href="product-full-width.php?id=<?php echo $row['id']; ?>">
                            <img src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($row['image']); ?>" alt="" style="width:600px; height:500px; object-fit:cover;">
                        </a>
                        <div class="ec-pro-actions">
                        </div>
                    </div>

                    <div class="product-info">
                           <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="add-to-cart-btn"> افزودن به سبد خرید</a>

                        <h5><?php echo $row['name']; ?></h5>
                        <span class="price"><?php echo $row['price']; ?> تومان</span>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    echo '</div>'; // پایان row
} else {
    echo "<p>محصولی یافت نشد</p>";
}
?>
                            
                        </div>
                        <!-- Ec Pagination Start -->
                        
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div id="shop_sidebar">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop page -->

    <!-- Footer Start -->
    <footer class="ec-footer section-space-mt">
        <div class="footer-container">
            <div class="footer-offer">
                <div class="container">
                   
                </div>
            </div>
            <div class="footer-top section-space-footer-p">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-3 ec-footer-contact">
                            <div class="ec-footer-widget">
                                <div class="ec-footer-logo"><a href="#"><img src="assets/images/logo/footer-logo.png"
                                            alt=""><img class="dark-footer-logo" src="assets/images/logo/dark-logo.png"
                                            alt="لوگو سایت" style="display: none;"></a></div>
                                <h4 class="ec-footer-heading">ارتباط با ما</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">یک آدرس فرضی در این مکان قرار گرفته است. غرب تهران
                                        </li>
                                        <li class="ec-footer-link"><span>تماس با ما:</span><a
                                                href="tel:+440123456789">+44
                                                0123 456 789</a></li>
                                        <li class="ec-footer-link"><span>ایمیل:</span><a
                                                href="/cdn-cgi/l/email-protection#aacfd2cbc7dac6cfeacfc987cfc7cbc3c684c9c5c7"><span
                                                    class="__cf_email__"
                                                    data-cfemail="0c2769746d617c60694c696f2169616d6560226f6361">[email&#160;protected]</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-info">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">اطلاعات</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="about-us.html">درباره ما</a></li>
                                        <li class="ec-footer-link"><a href="faq.html">سوالات متداول</a></li>
                                        <li class="ec-footer-link"><a href="#"> اطلاعات تحویل </a></li>
                                        <li class="ec-footer-link"><a href="contact-us.html">ارتباط با ما</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-account">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading"> اکانت </h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="#"> اکانت من </a></li>
                                        <li class="ec-footer-link"><a href="track-order.html"> تاریخچه سفارش </a></li>
                                        <li class="ec-footer-link"><a href="#"> لیست علاقه‌مندیها </a></li>
                                        <li class="ec-footer-link"><a href="#"> ویژه </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-service">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">خدمات</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="#"> تخفیف ها</a></li>
                                        <li class="ec-footer-link"><a href="#">سیاست حفظ حریم خصوصی</a></li>
                                        <li class="ec-footer-link"><a href="#">خدمات مشتری</a></li>
                                        <li class="ec-footer-link"><a href="terms-condition.html">قوانین و شرایط</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3 ec-footer-news">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading"> خبرنامه </h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"> !دریافت به روز رسانی های فوری در مورد محصولات ویژه و
                                            جدید ما
                                        </li>
                                    </ul>
                                    <div class="ec-subscribe-form">
                                        <form id="ec-newsletter-form" name="ec-newsletter-form" method="post"
                                            action="#">
                                            <div id="ec_news_signup" class="ec-form">
                                                <input class="ec-email" type="email" required=""
                                                    placeholder="ایمیل خود را اینجا وارد کنید..." name="ec-email"
                                                    value="">
                                                <button id="ec-news-btn" class="button btn-primary" type="submit"
                                                    name="subscribe" value=""><i class="ecicon eci-paper-plane-o"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Footer social Start -->
                        <div class="col text-left footer-bottom-left">
                            <div class="footer-bottom-social">
                                <span class="social-text text-upper">ما را دنبال کنید در:</span>
                                <ul class="mb-0">
                                    <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                                class="ecicon eci-facebook"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                                class="ecicon eci-twitter"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                                class="ecicon eci-instagram"></i></a></li>
                                    <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                                class="ecicon eci-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer social End -->
                        <!-- Footer Copyright Start -->
                        <div class="col text-center footer-copy">
                            <div class="footer-bottom-copy ">
                                <div class="ec-copy">کپی رایت © 1401-1402<a class="site-name text-upper"
                                        href="#">اکا<span>.</span></a>. تمامی حقوق محفوظ است</div>
                            </div>
                        </div>
                        <!-- Footer Copyright End -->
                        <!-- Footer payment -->
                        <div class="col footer-bottom-right">
                            <div class="footer-bottom-payment d-flex justify-content-end">
                                <div class="payment-link">
                                    <img src="assets/images/icons/payment.png" alt="">
                                </div>

                            </div>
                        </div>
                        <!-- Footer payment -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html"> کیف چرم پول برای زنان
                                    </a>
                                </h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>

                                <div class="ec-quickview-desc"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                    چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                    سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف
                                    بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده
                                    شناخت فراوان جامعه و متخصصان را می طلبد</div>
                                <div class="ec-quickview-price">
                                    <span class="old-price">10000 تومان</span>
                                    <span class="new-price">8000 تومان</span>
                                </div>

                                <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>رنگ</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <li><span style="background-color:#696d62;"></span></li>
                                                <li><span style="background-color:#d73808;"></span></li>
                                                <li><span style="background-color:#577023;"></span></li>
                                                <li><span style="background-color:#2ea1cd;"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <span>اندازه</span>
                                        <div class="ec-pro-variation-content">
                                            <ul class="ec-opt-size">
                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                        data-tooltip="Small">S</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Medium">M</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Large">X</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Extra Large">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-primary"><img src="assets/images/icons/cart.svg"
                                                class="svg_img pro_svg" alt=""> افزودن به کارت </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <!-- Footer navigation panel for responsive display -->
    <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
                            src="assets/images/icons/menu.svg" class="svg_img header_svg" alt=""></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><img
                            src="assets/images/icons/cart.svg" class="svg_img header_svg" alt=""><span
                            class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="index.html" class="ec-header-btn"><img src="assets/images/icons/home.svg"
                            class="svg_img header_svg" alt="icon"></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="wishlist.html" class="ec-header-btn"><img src="assets/images/icons/wishlist.svg"
                            class="svg_img header_svg" alt="icon"><span class="ec-cart-noti">4</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="login.html" class="ec-header-btn"><img src="assets/images/icons/user.svg"
                            class="svg_img header_svg" alt="icon"></a>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer navigation panel for responsive display end -->

    <!-- Recent Purchase Popup  -->
    <div class="recent-purchase">
        <img src="assets/images/product-image/1.jpg" alt="payment image">
        <div class="detail">
            <p>یک خریدار جدید خرید کرد</p>
            <h6>کفش بچگانه</h6>
            <p>10 دقیقه قبل</p>
        </div>
        <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
    </div>
    <!-- Recent Purchase Popup end -->

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
            <div class="header-icon"><img src="assets/images/icons/cart.svg" class="svg_img header_svg" alt=""></div>
            <span class="ec-cart-count cart-count-lable">3</span>
        </a>
    </div>
    <!-- Cart Floating Button end -->

    <!-- Whatsapp -->
    <div class="ec-style ec-right-bottom">
        <!-- Start Floating Panel Container -->
        <div class="ec-panel">
            <!-- Panel Header -->
            <div class="ec-header">
                <strong>کمک میخواهید؟</strong>
                <p>چت با ما در واتساپ</p>
            </div>
            <!-- Panel Content -->
            <div class="ec-body">
                <ul>
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="لطفا به من کمک کنید! محصول اشتباهی ثبت کرده ام- شماره سفارشم: #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_01.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>سحر دریا</span>
                                    <p>سحر 7 دقیقه قبل رفت</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="لطفا به من کمک کنید! محصول اشتباهی ثبت کرده ام- شماره سفارشم: #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_02.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-online"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>یلدا رفیع</span>
                                    <p>یلدا آنلاین است</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="لطفا به من کمک کنید! محصول اشتباهی ثبت کرده ام- شماره سفارشم: #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_03.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-offline"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>نرگس هیوا</span>
                                    <p>نرگس 30 دقیقه قبل رفت</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="لطفا به من کمک کنید! محصول اشتباهی ثبت کرده ام- شماره سفارشم: #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_04.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-offline"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>خدیجه مهر</span>
                                    <p>خدیجه 50 دقیقه قبل رفت</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                </ul>
            </div>
        </div>
        <!--/ End Floating Panel Container -->
        <!-- Start Right Floating Button-->
        <div class="ec-right-bottom">
            <div class="ec-box">
                <div class="ec-button rotateBackward">
                    <img class="whatsapp" src="assets/images/common/whatsapp.png" alt="whatsapp icon">
                </div>
            </div>
        </div>
        <!--/ End Right Floating Button-->
    </div>
    <!-- Whatsapp end -->

    <!-- Feature tools -->
    <div class="ec-tools-sidebar-overlay"></div>
    <div class="ec-tools-sidebar">
        <div class="tool-title">
            <h3>امکانات</h3>
        </div>
        <a href="#" class="ec-tools-sidebar-toggle in-out">
            <img alt="icon" src="assets/images/common/settings.png">
        </a>
        <div class="ec-tools-detail">
            <div class="ec-tools-sidebar-content ec-change-color ec-color-desc">
                <h3> تم رنگ </h3>
                <ul class="bg-panel">
                    <li class="active" data-color="01"><a href="#" class="colorcode1"></a></li>
                    <li data-color="02"><a href="#" class="colorcode2"></a></li>
                    <li data-color="03"><a href="#" class="colorcode3"></a></li>
                    <li data-color="04"><a href="#" class="colorcode4"></a></li>
                    <li data-color="05"><a href="#" class="colorcode5"></a></li>
                </ul>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3> بکگراند </h3>
                <ul class="bg-panel">
                    <li class="bg"><a class="back-bg-1" id="bg-1">Background-1</a></li>
                    <li class="bg"><a class="back-bg-2" id="bg-2">Background-2</a></li>
                    <li class="bg"><a class="back-bg-3" id="bg-3">Background-3</a></li>
                    <li class="bg"><a class="back-bg-4" id="bg-4">پیشفرض</a></li>
                </ul>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3> حالت تمام عرض</h3>
                <div class="ec-fullscreen-mode">
                    <div class="ec-fullscreen-switch">
                        <div class="ec-fullscreen-btn">حالت</div>
                        <div class="ec-fullscreen-on">روشن</div>
                        <div class="ec-fullscreen-off">خاموش</div>
                    </div>
                </div>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3>حالت تاریک</h3>
                <div class="ec-change-mode">
                    <div class="ec-mode-switch">
                        <div class="ec-mode-btn">حالت</div>
                        <div class="ec-mode-on">روشن</div>
                        <div class="ec-mode-off">خاموش</div>
                    </div>
                </div>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3>حالت راست‌چین</h3>
                <div class="ec-change-rtl active">
                    <div class="ec-rtl-switch">
                        <div class="ec-rtl-btn">راستچین</div>
                        <div class="ec-rtl-on ">روشن</div>
                        <div class="ec-rtl-off">خاموش</div>
                    </div>
                </div>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3>زبان</h3>
                <div class="ec-change-lang">
                    <span id="google_translate_element"></span>
                </div>
            </div>
            <div class="ec-tools-sidebar-content">
                <h3> پاک کردن ذخیره سازی محلی </h3>
                <a class="clear-cach" href="javascript:void(0)"> پاک کردن کش </a>
            </div>
        </div>
    </div>
    <!-- Feature tools end -->

    <!-- Vendor JS -->
    <script data-cfasync="false" src="assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery.notify.min.js"></script>
    <script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/nouislider.js"></script>
    <script src="assets/js/plugins/countdownTimer.min.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/infiniteslidev2.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>

    <!-- Main Js -->
    <script src="assets/js/main.js"></script>

</body>

</html>