<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس


$username = "اکانت";
if (isset($_SESSION['users_id'])) {
    $uid=$_SESSION['users_id'];
    $q=mysqli_query($conn,"SELECT name FROM users WHERE id=$uid LIMIT 1");
    $u=mysqli_fetch_assoc($q);
    if($u)$username=$u['name'];
}

 

//عدد سبد خرید
$cart_count=0;
if(isset($_SESSION['user_id'])){
    $uid=$_SESSION['user_id'];
    $q=mysqli_query($conn, "SELECT SUM(quantity) AS total FROM carts WHERE user_id=$uid");
    $row=mysqli_fetch_assoc($q);
    $cart_count=$row['total']??0;
}
echo $cart_count;
// session_start();
// // چک  که کاربر وارد شده یا نه
// if(!isset($_SESSION['users_id'])){
//     header("Location: login.html");
//     exit();
// }
// $user_id = $_SESSION['users_id'];
// $sql = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
// $result = mysqli_query($conn, $sql);
// $user = mysqli_fetch_assoc($result);

// echo "خوش آمدید، " . htmlspecialchars($user['name']);


//گرفتن همه کتاب ها از دیتابیس
$sql_all="SELECT * FROM books ORDER BY id DESC";
$result_all=mysqli_query($conn,$sql_all);

$books=[];
if($result_all && mysqli_num_rows($result_all)>0){
    //گرفتن هرردیف و دخیره در books
    while($row=mysqli_fetch_assoc($result_all)){
        $books[]=$row;
    }
}


// گرفتن دسته‌بندی از URL
$category = isset($_GET['category']) ? trim($_GET['category']) : null;

$books_category=[];

// اگر دسته‌بندی انتخاب شده بود
if($category){
    $category_safe = mysqli_real_escape_string($conn,$category);
    $sql_category = "SELECT * FROM books WHERE category='$category_safe' ORDER BY id DESC";
    $result_category = mysqli_query($conn,$sql_category);

    if($result_category && mysqli_num_rows($result_category)>0){
        while($row=mysqli_fetch_assoc($result_category)){
            $books_category[]=$row;
        }
    }
}

$display_books = !empty($books_category) ? $books_category : $books;



// گرفتن آخرین 4 کتاب تخفیف‌دار، اگر کمتر از 4 بود همونارو برمی‌گردونه
// $sql_last_discounted = "SELECT * FROM books WHERE discount != 0 ORDER BY created_at DESC LIMIT 4";
// $result_last_discounted = mysqli_query($conn, $sql_last_discounted);

// $last_discounted_books = [];
// if($result_last_discounted && mysqli_num_rows($result_last_discounted) > 0){
//     while($row = mysqli_fetch_assoc($result_last_discounted)){
//         // محاسبه قیمت بعد از تخفیف
//         $row['final_price'] = $row['price'] - ($row['price'] * $row['discount'] / 100);
//         $last_discounted_books[] = $row;
//     }
// }




?>
<!--========================================================= 
    Item Name: Ekka - Ecommerce HTML Template.
    Author: ashishmaraviya
    Version: 2.0
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
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>اکا- قالب اچ تی ام ال ووکامرس</title>
    <meta name="keywords"
        content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">

    <!-- site Favicon -->
    <link rel="icon" href="assets/images/favicon/favicon-3.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-3.png" />
    <meta name="msapplication-TileImage" content="assets/images/favicon/favicon-3.png" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/demo3.css" />

</head>

<body>
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    <header class="ec-header">
        <!--Ec Header Top Start -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Top phone Start -->
                    <div class="col header-top-left">
                        <div class="header-top-call">
                            <img src="assets/images/icons/top-call.svg" class="svg_img top_svg" alt="" /> شماره:
                            <a href="tel:+48735527287"> +12345678910</a>
                        </div>
                    </div>
                    <!-- Header Top phone End -->
                    <!-- Header Top call Start -->
                    <div class="col header-top-center">
                        <div class="header-top-call">
                            سفارش آنلاین یا تماس با ما 12345678910
                        </div>
                    </div>
                    <!-- Header Top call End -->
                    <!-- Header Top Language Currency -->
                    <div class="col header-top-right d-none d-lg-block">
                        <div class="header-top-right-inner d-flex justify-content-end">
                            <!-- Currency Start
                            <div class="header-top-lan-curr header-top-curr dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">ارز<i
                                        class="ecicon eci-angle-down" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu">
                                    <li class="active"><a class="dropdown-item" href="#">دلار</a></li>
                                    <li><a class="dropdown-item" href="#">یورو</a></li>
                                </ul>
                            </div> -->
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <!-- <div class="header-top-lan-curr header-top-lan dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">زبان <i
                                        class="ecicon eci-angle-down" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu">
                                    <li class="active"><a class="dropdown-item" href="#">انگلستان</a></li>
                                    <li><a class="dropdown-item" href="#">ایتالیا</a></li>
                                </ul>
                            </div> -->
                            <!-- Language End -->
                            <!-- Social Start -->
                            <div class="header-top-social">
                                <ul class="mb-0">
                                    <!-- <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a>
                                    </li> -->
                                    <!-- <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a></li> -->
                                    <li class="list-inline-item"><a href="#"><i class="ecicon eci-instagram"></i></a>
                                    </li>
                                    <!-- <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a>
                                    </li> -->
                                </ul>
                            </div>
                            <!-- Social End -->
                        </div>
                    </div>
                    <!-- Header Top Language Currency -->
                    <!-- Header Top responsive Action -->
                    <div class="col header-top-res d-lg-none">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <!-- <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="assets/images/icons/user.svg" class="svg_img header_svg" alt="" /></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="register.html">ثبت نام</a></li>
                                    <li><a class="dropdown-item" href="user-profile.html">پروفایل کاربر</a></li>
                                    <li><a class="dropdown-item" href="login.html">ورود</a></li>
                                </ul>
                            </div> -->
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <!-- <a href="#" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                        class="svg_img header_svg" alt="" /></div>
                                <span class="ec-header-count ec-wishlist-count">0</span>
                            </a> -->
                            <!-- Header Cart End -->
                            <!-- Header Cart Start -->
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><img src="assets/images/icons/pro_cart.svg"
                                        class="svg_img header_svg" alt="" /></div>
                                <!-- <span class="ec-header-count ec-cart-count">3</span>  تعدداد سبد خرید!!! -->
                            </a>
                            <!-- Header Cart End -->
                            <!-- Header menu Start -->
                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle ec-d-l d-lg-none">
                                <i class="ecicon eci-bars"></i>
                            </a>
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
                    <div class="header-bottom-flex">
                        <!-- Ec Header Logo Start -->
                        <!-- <div class="align-self-center ec-header-logo ">
                            <div class="header-logo">
                                <a href="index.html"><img src="assets/images/logo/logo-3.png" alt="Site Logo" /><img
                                        class="dark-logo" src="assets/images/logo/dark-logo-3.png" alt="Site Logo"
                                        style="display: none;" /></a>
                            </div>
                        </div> -->
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center ec-header-search">
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

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center ec-header-cart">
                            <div class="ec-header-bottons">
                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                            src="assets/images/icons/user.svg" class="svg_img header_svg " alt="" /><span
                                            class="ec-btn-title"><?php echo $username;?></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="register.html">ثبت نام</a></li>
                                        <li><a class="dropdown-item" href="user-profile.html">پروفایل کاربر</a></li>
                                        <li><a class="dropdown-item" href="login.html">ورود</a></li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                                <!-- Header wishlist Start -->
                                <!-- <a href="#" class="ec-header-btn ec-header-wishlist">
                                    <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                            class="svg_img header_svg" alt="" /></div><span
                                        class="ec-header-count ec-cart-wishlist">0</span>
                                    <span class="ec-btn-title">علاقه مندی ها</span>
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
                            <a href="index.html"><img src="assets/images/logo/logo-3.png" alt="Site Logo" /><img
                                    class="dark-logo" src="assets/images/logo/dark-logo-3.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    <div class="align-self-center ec-header-search">
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
        <div id="ec-main-menu-desk" class="sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <!-- <div class="col-sm-2 ec-category-block">
                        <div class="ec-category-menu">
                            <div class="ec-category-toggle"><span class="ec-category-title">دسته بندی ها</span><i
                                    class="ecicon eci-angle-down" aria-hidden="true"></i>
                            </div>
                            <div class="ec-category-content">
                                <div id="ec-category-menu" class="ec-category-menu">
                                    <ul class="ec-category-wrapper">
                                        <li><a title="" class="ec-cat-menu-link" href="#">کتاب فارسی</a></li>
                                        <li><a title="" class="ec-cat-menu-link" href="#">کتاب انگلیسی/</a></li>
                                        <li><a title="" class="ec-cat-menu-link" href="#">کتاب کودک</a></li>
                                        <li><a title="" class="ec-cat-menu-link" href="#">وسیله های الکترونیکی</a></li> -->
                                        <!-- <li><a title="" class="ec-cat-menu-link" href="#">مبلمان شرکتی</a></li> -->
                                        <!-- س
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-10 ec-main-menu-block align-self-center d-none d-lg-block">
                        <div class="ec-main-menu">
                            <ul>
                                <li><a href="javascript:void(0)">خانه</a></li>
                                <li class="dropdown position-static"><a href="javascript:void(0)">دسته بندی ها</a>
                                    <ul class="mega-menu d-block">
                                        <li class="d-flex">
                                            <!-- <ul class="d-block">
                                                <li class="menu_title"><a href="javascript:void(0)">ورژن کلاسیک</a></li>
                                                <li><a href="shop-left-sidebar-col-3.html">سایدبار چپ 3 ستونه</a>
                                                </li>
                                                <li><a href="shop-left-sidebar-col-4.html">سایدبار چپ 4 ستونه</a>
                                                </li>
                                                <li><a href="shop-right-sidebar-col-3.html">سایدبار راست 3 ستونه</a>
                                                </li>
                                                <li><a href="shop-right-sidebar-col-4.html">سایدبار راست 4 ستونه</a>
                                                </li>
                                                <li><a href="shop-full-width.html">تمام عرض 4 ستونه</a></li>
                                            </ul> -->
                                            <ul class="d-block">
                                                
                                                <li><a href="shop-left-sidebar-col-3.php"> همه محصولات</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=رمان"> رمان</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=کودک">کودک</a></li>
                                                <li><a href="shop-left-sidebar-col-3.php?category=زبان انگلیسی"> زبان انگلیسی</a></li>
                                            </ul>                           
                                            <!-- <ul class="d-block">
                                                <li class="menu_title"><a href="javascript:void(0)">ورژن لیست</a>
                                                </li>
                                                <li><a href="shop-list-left-sidebar.html">فروشگاه با سایدبار چپ</a></li>
                                                <li><a href="shop-list-right-sidebar.html">فروشگاه با سایدبار راست</a>
                                                </li>
                                                <li><a href="shop-list-banner-left-sidebar.html"> بنر سایدبار چپ </a>
                                                </li>
                                                <li><a href="shop-list-banner-right-sidebar.html">بنر سایدبار راست</a>
                                                </li>
                                                <li><a href="shop-list-full-col-2.html">تمام عرض 2 ستونه</a></li>
                                            </ul> -->
                                        </li>
                                        <li>
                                            <!-- <ul class="ec-main-banner w-100">
                                                <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img
                                                            class="img-responsive" src="assets/images/menu-banner/9.jpg"
                                                            alt=""></a>
                                                </li>
                                                <li><a class="p-0" href="shop-left-sidebar-col-4.html"><img
                                                            class="img-responsive"
                                                            src="assets/images/menu-banner/10.jpg" alt=""></a>   عکسای زیر دسته بندی
                                                </li>
                                                <li><a class="p-0" href="shop-right-sidebar-col-3.html"><img
                                                            class="img-responsive"
                                                            src="assets/images/menu-banner/11.jpg" alt=""></a>
                                                </li>
                                                <li><a class="p-0" href="shop-right-sidebar-col-4.html"><img
                                                            class="img-responsive"
                                                            src="assets/images/menu-banner/12.jpg" alt=""></a>
                                                </li>
                                            </ul> -->
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:void(0)">محصولات</a>   <!--محصول سایدبار چپ خوبهههههههههههههههههههههههههههههههههه-->
                                    <ul class="sub-menu">
                                        <!-- <li class="dropdown position-static"><a href="javascript:void(0)">صفحه محصولات
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-left-sidebar.html">محصول سایدبار چپ</a></li>
                                                <li><a href="product-right-sidebar.html">محصول سایدبار راست</a></li>
                                            </ul>
                                        </li> -->
                                        <!-- <li class="dropdown position-static"><a href="javascript:void(0)">محصول 360 درجه
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="product-360-left-sidebar.html">360 ساید بار چپ</a></li>
                                                <li><a href="product-360-right-sidebar.html">360 ساید بار راست</a></li>
                                            </ul>
                                        </li> -->
                                        <!-- <li class="dropdown position-static"><a href="javascript:void(0)">محصول ویدئویی
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
                                        <li><a href="product-gallery-full-width.html">تمام عرض گالری</a></li> -->
                                    </ul>
                                <!-- </li>
                                <li class="dropdown"><a href="javascript:void(0)">صفحات </a>
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
                                        title="NEW"></span><a href="javascript:void(0)">صفحات</a>
                                    <ul class="sub-menu ec-right-0">
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
                                        <li class="dropdown position-static"><a href="javascript:void(0)">ریست رمزعبور
                                                <i class="ecicon eci-angle-left"></i></a>
                                            <ul class="sub-menu sub-menu-child">
                                                <li><a href="email-template-forgot-password-1.html">ریست رمزعبور 1</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-2.html">ریست رمزعبور 2</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-3.html">ریست رمزعبور 3</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-4.html">ریست رمزعبور 4</a>
                                                </li>
                                                <li><a href="email-template-forgot-password-5.html">ریست رمزعبور 5</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown position-static"><a href="javascript:void(0)"> ایمیل
                                                تبلیغاتی
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
                                    <ul class="sub-menu ec-right-0">
                                        <li><a href="blog-left-sidebar.html">بلاگ سایدبار چپ</a></li>
                                        <li><a href="blog-right-sidebar.html">بلاگ سایدبار راست</a></li>
                                        <li><a href="blog-detail-left-sidebar.html">جزییات بلاگ سایدبار چپ</a></li>
                                        <li><a href="blog-detail-right-sidebar.html">جزییات بلاگ سایدبار راست</a></li>
                                        <li><a href="blog-full-width.html">بلاگ تمام عرض</a></li>
                                        <li><a href="blog-detail-full-width.html">جزییات بلاگ تمام عرض</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="javascript:void(0)">عناصر</a>
                                    <ul class="sub-menu ec-right-0">
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
        <!-- Ekka Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">منو</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="javascript:void(0)">خانه</a></li>

                        <li><a href="javascript:void(0)">دسته بندی ها</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0)">ورژن کلاسیک</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-left-sidebar-col-3.html">سایدبار چپ 3 ستونه</a></li>
                                        <li><a href="shop-left-sidebar-col-4.html">سایدبار چپ 4 ستونه</a></li>
                                        <li><a href="shop-right-sidebar-col-3.html">سایدبار راست 3 ستونه</a></li>
                                        <li><a href="shop-right-sidebar-col-4.html">سایدبار راست 4 ستونه</a></li>
                                        <li><a href="shop-full-width.html">تمام عرض 4 ستونه</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ورژن کلاسیک</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-banner-left-sidebar-col-3.html"> بنر سایدبار چپ 3 ستونه</a>
                                        </li>
                                        <li><a href="shop-banner-left-sidebar-col-4.html"> بنر سایدبار چپ 4 ستونه</a>
                                        </li>
                                        <li><a href="shop-banner-right-sidebar-col-3.html"> بنر سایدبار راست 3 ستونه
                                            </a></li>
                                        <li><a href="shop-banner-right-sidebar-col-4.html"> بنر سایدبار راست 4 ستونه
                                            </a></li>
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
                                        <li><a href="shop-list-banner-right-sidebar.html">بنر سایدبار راست</a></li>
                                        <li><a href="shop-list-full-col-2.html">تمام عرض 2 ستونه</a></li>
                                    </ul>
                                </li>
                                <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img class="img-responsive"
                                            src="assets/images/menu-banner/1.jpg" alt=""></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">محصولات</a>
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
                                <li><a href="javascript:void(0)">محصول ویدئویی</a>
                                    <ul class="sub-menu">
                                        <li><a href="product-video-left-sidebar.html">سایدبار چپ ویدئویی</a></li>
                                        <li><a href="product-video-right-sidebar.html">سایدبار راست ویدئویی</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">گالری محصول</a>
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
                        <li><a href="javascript:void(0)">صفحات</a>
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
                                <li><a href="javascript:void(0)">ایمیل ریست رمزعبور/a>
                                        <ul class="sub-menu">
                                            <li><a href="email-template-forgot-password-1.html">ریست رمزعبور 1</a></li>
                                            <li><a href="email-template-forgot-password-2.html">ریست رمزعبور 2</a></li>
                                            <li><a href="email-template-forgot-password-3.html">ریست رمزعبور 3</a></li>
                                            <li><a href="email-template-forgot-password-4.html">ریست رمزعبور 4</a></li>
                                            <li><a href="email-template-forgot-password-5.html">ریست رمزعبور 5</a></li>
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
                                <li><a href="javascript:void(0)">صفحات اکانت فروشنده/a>
                                        <ul class="sub-menu">
                                            <li><a href="vendor-dashboard.html">داشبرد فروشنده</a></li>
                                            <li><a href="vendor-profile.html">پروفایل فروشنده</a></li>
                                            <li><a href="vendor-uploads.html">آپلودهای فروشنده</a></li>
                                            <li><a href="vendor-settings.html">تنظیمات فروشنده</a></li>
                                        </ul>
                                </li>
                                <li><a href="javascript:void(0)">صفحات اکانت کاربر/a>
                                        <ul class="sub-menu">
                                            <li><a href="user-profile.html">پروفایل کاربر</a></li>
                                            <li><a href="user-history.html">تاریخچه</a></li>
                                            <li><a href="wishlist.html">علاقه مندی ها</a></li>
                                            <li><a href="track-order.html">پیگیری سفارش</a></li>
                                            <li><a href="user-invoice.html">فاکتور</a></li>
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
                        <li><a href="javascript:void(0)">صفحات </a>
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
                        <li><a href="offer.html">پیشنهادات داغ</a></li>
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <div class="header-top-lan-curr">
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">زبان<i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">انگلستان</a></li>
                                <li><a class="dropdown-item" href="#">ایتالیا</a></li>
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
                                <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- Ekka Menu End -->
    </header>
    <!-- Header End  -->

    <!-- Ekka Cart Start -->
    <div class="ec-side-cart-overlay"></div>
    <div id="ec-side-cart" class="ec-side-cart">
        <div class="ec-cart-inner">
            <div class="ec-cart-top">
                <div class="ec-cart-title">
                    <span class="cart_title">سبد خرید</span>
                    <button class="ec-close">×</button>
                </div>
                <ul class="eccart-pro-items">
                    <li>
                        <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                src="assets/images/product-image/19_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="single-product-left-sidebar.html" class="cart_pro_title">صندلی صندلی تک</a>
                            <span class="cart-price"><span>450 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                src="assets/images/product-image/20_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">چراغ شب جبرا</a>
                            <span class="cart-price"><span>450 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                    <li>
                        <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                src="assets/images/product-image/21_1.jpg" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product-left-sidebar.html" class="cart_pro_title">صندلی کلاسیک کامبروک</a>
                            <span class="cart-price"><span>450 تومان</span> x 1</span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-right">مجموع :</td>
                                <td class="text-left">135000 تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right">وای (20%) :</td>
                                <td class="text-left">27000 تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right">جمع :</td>
                                <td class="text-left primary-color">162000 تومان</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cart_btn">
                    <a href="cart.html" class="btn btn-primary">دیدن سبد</a>
                    <a href="checkout.html" class="btn btn-secondary">ادامه خرید</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Ekka Cart End -->

    <!-- Main Slider Start-->

    <div class="ec-main-slider section section-space-mb">
        <div class="ec-slider">
             
            <div class="ec-slide-item d-flex slide-1">
                <img src="assets/images/main-slider-banner/arrow-7.jpg" class="main_banner_arrow_img" alt="" />
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h2 class="ec-slide-stitle">کتابتو باز کن-تو داستان پرواز کن</h2>
                                <h1 class="ec-slide-title">بیا کتاب بخونیم</h1>
                                <p>در این کلینیک اسرارآمیز، گربه‌ها نقش درمانگرانی مهربان را ایفا می‌کنند. آن‌ها به بیماران کمک می‌کنند که از نگرانی‌های غیرضروری رها شوند، زندگی را با دیدی تازه ببینند و به لحظه‌ی حال توجه کنند. د</p>
                                <span class="ec-slide-disc">شروع از<span>150 تومان</span></span>
                                <a href="#" class="btn btn-lg btn-secondary">خرید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-slide-item d-flex slide-2">
                 <img src="assets/images/main-slider-banner/arrow-7.jpg" class="main_banner_arrow_img" alt="" />
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h2 class="ec-slide-stitle">استایل و مبلمان</h2>
                                <h1 class="ec-slide-title">صندلی خاص</h1>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                <span class="ec-slide-disc">شروع از<span>150 تومان</span></span>
                                <a href="#" class="btn btn-lg btn-secondary">خرید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="ec-slide-item d-flex slide-3">
                <img src="assets/images/main-slider-banner/arrow-7.jpg" class="main_banner_arrow_img" alt="" />
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content slider-animation">
                                <h2 class="ec-slide-stitle">استایل و مبلمان</h2>
                                <h1 class="ec-slide-title">صندلی باغ</h1>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                <span class="ec-slide-disc">شروع از<span>150 تومان</span></span>
                                <a href="#" class="btn btn-lg btn-secondary">خرید</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div> 
    <!-- Main Slider End -->

    <!--  category Section Start -->
 
    <section class="section ec-category-section section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">کتاب ها</h2>
                        <!-- <p class="sub-title">محصولات ما را بررسی کنید.</p> -->
                    </div>
                    <div class="section-btn">
                        <span class="ec-section-btn"><a class="btn-primary" href="shop-left-sidebar-col-3.php"> مشاهده همه کتاب ها </a></span>
                    </div>
                </div>
            </div> 
            <div class="row">
       <?php
       $last_four=array_slice($books,0,4);
       foreach($last_four as $book){?>
       
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="ec-product-inner">
            <div class="ec-pro-image-outer">
                <div class="ec-pro-image">
                    <a href="product-full-width.php?id=<?php echo $book['id']; ?>">
                        <img src="assets/images/products/<?php echo $book['image']; ?>" alt=""  style="width:600px; height:500px; object-fit:cover;">
                    </a>
                </div>
            </div>

            <div class="ec-pro-content">
                <h6 class="ec-pro-title"><?php echo $book['name']; ?></h6>
                <span class="ec-price"><?php echo $book['price']; ?> تومان</span>
                <a href="add_to_cart.php?id=<?php echo $book['id']; ?>" class="add-to-cart-btn"> افزودن به سبد خرید</a></div>
        </div>
    </div>
                            <?php }?>
                            <!-- <div class="ec-cat-desc">
                                <span class="ec-section-btn"><a href="shop-left-sidebar-col-3.html"
                                        class="btn-primary">پرفروش ترین ها</a></span>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="ec_cat_content">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <img src="assets/images/category-image/2.jpg" alt="" />
                            </div>
                            <div class="ec-cat-desc">
                                <span class="ec-section-btn"><a href="shop-left-sidebar-col-3.html"
                                        class="btn-primary">جدیدترین ها</a></span>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="ec_cat_content">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <img src="assets/images/category-image/3.jpg" alt="" />
                            </div>
                            <div class="ec-cat-desc">
                                <span class="ec-section-btn"><a href="shop-left-sidebar-col-3.html"
                                        class="btn-primary">جدیدترین ها</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="ec_cat_content">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <img src="assets/images/category-image/4.jpg" alt="" />
                            </div>
                            <div class="ec-cat-desc">
                                <span class="ec-section-btn"><a href="shop-left-sidebar-col-3.html"
                                        class="btn-primary">برترین کتاب های کودک</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="ec_cat_content">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <img src="assets/images/category-image/5.jpg" alt="" />
                            </div>
                            <div class="ec-cat-desc">
                                <span class="ec-section-btn"><a href="shop-left-sidebar-col-3.html"
                                        class="btn-primary">برترین رمان های ادبیات نوجوان</a></span>     عکس لود نشد
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!--category Section End -->

    <!-- ec Banner Section Start  کشف کن  -->
    
    <section class="ec-banner section section-space-p">
        <h2 class="d-none">بنر</h2>
        <div class="ec-banners" >
            <div class="ec-banner-left col-sm-6" >
                <div class="ec-banner-block ec-banner-block-1 col-sm-12 ">
                    <?php 
                    if(!empty($books)){
                    $lastBook=$books[0];

                    ?>
                    <div class="banner-block"  >
                       
                        <img src="assets/images/products/<?php echo $lastBook['image']; ?>" alt=""  style="width:800px; height:900px; object-fit:cover;" />
                        <div class="banner-content">
                            <div class="banner-text">
                                <span class="ec-banner-stitle">بیا باهم کتاب بخونیم</span>
                                <span class="ec-banner-title"><?php echo $lastBook['name']; ?></span>
                                <p> <?php echo $lastBook['price']; ?> <br> تومان</p>
                            </div>
                            <?php }?>
                            <span class="ec-banner-btn"><a href="product-full-width.php?id=<?php echo htmlentities($lastBook['id']);?>" class="btn-primary" type="submit">کشف کن </a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-banner-right col-sm-6" >
                <div class="ec-banner-block ec-banner-block-1 col-sm-12 ">
                    <?php 
                    if(!empty($books)){
                    $firstBook=$books[1];

                    ?>
                    <div class="banner-block"  >
                       
                        <img src="assets/images/products/<?php echo $firstBook['image']; ?>" alt=""  style="width:800px; height:900px; object-fit:cover;" />
                        <div class="banner-content">
                            <div class="banner-text">
                                <span class="ec-banner-stitle">بیا باهم کتاب بخونیم</span>
                                <span class="ec-banner-title"><?php echo $firstBook['name']; ?></span>
                                <p> <?php echo $firstBook['price']; ?> <br> تومان</p>
                            </div>
                            <?php }?>
                            <span class="ec-banner-btn"><a href="product-full-width.php?id=<?php echo htmlentities($firstBook['id']);?>" class="btn-primary" type="submit">کشف کن </a></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="ec-banner-right col-sm-6">
                <div class="ec-banner-block ec-banner-block-2 col-sm-12">
                    <div class="banner-block">
                        <img src="assets/images/banner/16.jpg" alt="" />
                        <div class="banner-content"> -->
                            <!-- <div class="banner-text">
                                <span class="ec-banner-stitle">استثنایی</span>
                                <span class="ec-banner-title">طراحی داخلی<br> زیبا</span>
                            </div> -->
                            <!-- <span class="ec-banner-btn"><a href="#" class="btn-primary">کشف کن</a></span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="ec-banner-block ec-banner-block-3 col-sm-6">
                    <div class="banner-block">
                        <a href="#">
                            <img src="assets/images/banner/17.jpg" alt="" />
                            <div class="banner-content">
                                <div class="banner-text">
                                    <span class="ec-banner-stitle">انحصاری</span>
                                    <span class="ec-banner-title">مبل زندگی</span>
                                    <span class="ec-banner-desc">برای فروش فقط <span>50000 تومان</span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="ec-banner-block ec-banner-block-4 col-sm-6">
                    <div class="banner-block">
                        <a href="#">
                            <img src="assets/images/banner/18.jpg" alt="" />
                            <div class="banner-content">
                                <div class="banner-text">
                                    <span class="ec-banner-stitle">بهترین های 1402</span>
                                    <span class="ec-banner-title">میز مینی</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- ec Banner Section End -->


   
<!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">بررسی کنید</h2>
                        <!-- <p class="sub-title">فرصت محدود.</p> -->
                    </div>
                    <?php $category=isset($_GET['category'])?trim($_GET['category']):null;?>
                    <div class="section-btn">
                        <ul class="ec-pro-tab-nav nav">
                            <li class="nav-item"> <a class="nav-link <?php echo ($category == 'کودک') ? 'active' : ''; ?>"
               href="index.php?category=کودک">کودک</a></li>
                            <li class="nav-item"> <a class="nav-link <?php echo ($category == 'رمان') ? 'active' : ''; ?>"
               href="index.php?category=رمان">رمان</a></li>
                            <li class="nav-item"> <a class="nav-link <?php echo ($category == 'زبان انگلیسی') ? 'active' : ''; ?>"
               href="index.php?category=زبان انگلیسی">زبان انگلیسی</a></li>
                        </ul>
                    </div>
                </div>
            </div>
             
<?php
$category = isset($_GET['category']) ? trim($_GET['category']) : null;
$display_books = $category ? $books_category : $books;
?>

<div class="row">
<style>
    .ec-product-inner img{
        width: 120%;
        height: 560px;
        object-fit: cover;
        border-radius: 10px;
    } </style>
<?php if (!empty($display_books)): ?>
    <?php foreach ($display_books as $book): ?>
    
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6">
            <div class="ec-product-inner">
                <div class="ec-pro-image">
                    <a href="product-full-width.php?id=<?php echo $book['id']; ?>" class="image">
                        <img src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']); ?>" 
                             alt="<?php echo htmlspecialchars($book['name']); ?>" />
                    </a>
                    <div class="ec-pro-actions">
                        <button href="add_to_cart.php?id=<?php echo $book['id']; ?>" title="افزودن به سبد" class="add-to-cart">
                            <img src="assets/images/icons/cart.svg" class="svg_img pro_svg" alt="">
                        </button>
                        <a href="#" class="ec-btn-group wishlist" title="علاقه‌مندی">
                            <img src="assets/images/icons/pro_wishlist.svg" class="svg_img pro_svg" alt="">
                        </a>
                    </div>
                </div>

                <div class="ec-pro-content">
                    <h5 class="ec-pro-title">
                        <a href="product-full-width.php?id=<?php echo $book['id']; ?>">
                            <?php echo htmlspecialchars($book['name']); ?>
                        </a>
                    </h5>

                    <span class="ec-price">
                        <span class="new-price"><?php echo htmlspecialchars($book['price']); ?> تومان</span>
                    </span>

                    <a href="product-full-width.php?id=<?php echo $book['id']; ?>" class="btn btn-primary mt-2">
                        جزئیات
                    </a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>

</div>
       
    </section>
    <!-- ec Product tab Area End -->

    <!--  offer Section Start -->
    <!-- <section class="section ec-offer-section section-space-mt section-space-mb">
        <h2 class="d-none">پیشنهاد</h2> -->
        <!-- <img src="assets/images/offer-image/offer_bg.jpg" alt="" class="offer_bg" /> -->
        <!-- <div class="container">
            <div class="row">
                <div class="ec-offer-inner">
                    <div class="col-sm-4 ec-offer-content">
                        <h2 class="ec-offer-stitle">شنبه خوش شانس</h2>
                        <h2 class="ec-offer-title">40% تخفیف</h2>
                        <span class="ec-offer-desc">تمام مبلمان مدرن</span>
                        <div class="countdowntimer"><span id="ec-offer-count"></span></div>
                        <span class="ec-offer-btn"><a href="#" class="btn btn-lg btn-secondary">خرید</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- offer Section End -->

    <!-- Trending Item Start -->
    <section class="section ec-trend-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <!-- <div class="section-title">
                        <h2 class="ec-title">تخفیف ها</h2>
                        <p class="sub-title">محصولات ما را بررسی کنید.</p>
                    </div> -->
                    <!-- <div class="section-btn">
                        <span class="ec-section-btn"><a class="btn-secondary" href="shop-left-sidebar-col-3.html">مشاهده
                                همه</a></span>
                    </div> -->
                </div>
            </div>
<?php 
// بررسی وجود کتاب‌های دارای تخفیف
if(!empty($last_discounted_books)) {
?>
    <div class="row"> 

        <?php foreach($last_discounted_books as $book) { ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content mb-4">
                <div class="ec-product-inner">
                    <div class="ec-pro-image-outer">
                        <div class="ec-pro-image">
                           
                            <a href="#?id=<?php echo $book['id']; ?>" class="image">
                                <img class="main-image" src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['name']); ?>" />
                                <img class="hover-image" src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['name']); ?>" />
                            </a>
                          
                            <!-- <div class="ec-pro-actions">
                                <button title="افزودن به سبد" class="add-to-cart"><img src="assets/images/icons/cart.svg" class="svg_img pro_svg" alt="" /></button>
                                <a href="compare.html" class="ec-btn-group compare" title="مقایسه"><img src="assets/images/icons/compare.svg" class="svg_img pro_svg" alt="" /></a>
                                <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="مشاهده" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><img src="assets/images/icons/quickview.svg" class="svg_img pro_svg" alt="" /></a>
                                <a class="ec-btn-group wishlist" title="علاقه مندی"><img src="assets/images/icons/pro_wishlist.svg" class="svg_img pro_svg" alt="" /></a>
                            </div> -->
                           
                        </div>
                    </div>

                    <div class="ec-pro-content">
                        <h5 class="ec-pro-title">
                            <a href="#?id=<?php echo $book['id']; ?>">
                                <?php echo htmlspecialchars($book['name']); ?>
                            </a>
                        </h5>
                        <span class="ec-price">
                            <span class="old-price"><?php echo htmlspecialchars($book['price']); ?> تومان</span>
                            <span class="new-price"><?php echo htmlspecialchars($book['final_price']); ?> تومان</span>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div> 
<?php } ?>
    </section>
    <!-- Trending Item end -->

    <!--  services Section Start -->
    <section class="section ec-services-section section-space-p">
        <h2 class="d-none">خدمات</h2>
        <div class="container">
            <div class="row mb-minus-30">
                <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-4">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <img src="assets/images/icons/service_1.svg" class="svg_img" alt="" />
                        </div>
                        <div class="ec-service-desc">
                            <h2>تحویل نامحدود</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-4">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <img src="assets/images/icons/service_3.svg" class="svg_img" alt="" />
                        </div>
                        <div class="ec-service-desc">
                            <h2>بازگشت رایگان</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-4">
                    <div class="ec_ser_inner">
                        <div class="ec-service-image">
                            <img src="assets/images/icons/service_2.svg" class="svg_img" alt="" />
                        </div>
                        <div class="ec-service-desc">
                            <h2>24/7 پشتیبانی</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--services Section End -->

    <!-- ec testimonial Start -->
    <!-- <section class="section ec-test-section section-space-ptb-100 section-space-mt section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">نظرات</h2>
                        <p class="sub-title">مشتریان ما درباره ما چه می گویند!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ec-test-outer">
                    <ul id="ec-testimonial-slider">
                        <li class="ec-test-item">
                            <div class="ec-test-inner">
                                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                                        src="assets/images/testimonial/1.jpg" /></div>
                                <div class="ec-test-content">
                                    <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                                            class="svg_img test_svg" alt="" /></div>
                                    <div class="ec-test-desc">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                        و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                        سطرآنچنان که لازم است.</div>
                                    <div class="ec-test-name">جنیفر براون</div>
                                    <div class="ec-test-designation">مدیر ایزد</div>
                                </div>
                            </div>
                        </li>
                        <li class="ec-test-item">
                            <div class="ec-test-inner">
                                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                                        src="assets/images/testimonial/2.jpg" /></div>
                                <div class="ec-test-content">
                                    <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                                            class="svg_img test_svg" alt="" /></div>
                                    <div class="ec-test-desc">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                        و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                        سطرآنچنان که لازم است.</div>
                                    <div class="ec-test-name">ماریا یزیم</div>
                                    <div class="ec-test-designation">مدیر ایزد</div>
                                </div>
                            </div>
                        </li>
                        <li class="ec-test-item">
                            <div class="ec-test-inner">
                                <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                                        src="assets/images/testimonial/3.jpg" /></div>
                                <div class="ec-test-content">
                                    <div class="ec-test-icon"><img src="assets/images/testimonial/quote-3.svg"
                                            class="svg_img test_svg" alt="" /></div>
                                    <div class="ec-test-desc">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                        و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                        سطرآنچنان که لازم است.</div>
                                    <div class="ec-test-name">موریس سولمن</div>
                                    <div class="ec-test-designation">مدیر ایزد</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ec testimonial end -->

    <!-- Ec Instagram Start -->
    <section class="section ec-instagram-section section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">اینستاگرام <span>#فروشگاه</span></h2>
                        <p class="sub-title">داستان ها را در اینستاگرام اضافه کنید و به ما بگویید که چگونه محصول ما را
                            در زندگی تان تاثیر می گذارد.
                        </p>
                    </div>
                    <div class="section-btn">
                        <span class="ec-section-btn"><a class="btn-secondary" href="#">ما را دنبال کنید</a></span>
                    </div>
                </div>
            </div>
            <style>
                .ec-insta-item {
                 flex: 0 0 20%;  /* هر کارت 20٪ عرض ردیف را بگیرد (۵ کارت در یک ردیف) */
                 padding: 5px;   /* فاصله بین کارت‌ها */
                 box-sizing: border-box;
               }
               .ec-insta-inner img {
                 width: 100%;      
                 height: 200px;    
                 object-fit: cover; 
                 border-radius: 5px; 
               }
           </style>
            <?php
$last_6 = array_slice($books, 0, 6);
if(!empty($last_6)) {
?>
<div class="row">
    <div class="ec-insta-wrapper">
        <div class="ec-insta-outer">
            <div class="insta-auto">
                <?php foreach($last_6 as $book) { ?>
                    <!-- instagram/book item -->
                    <div class="ec-insta-item">
                        <div class="ec-insta-inner">
                            <a href="#" target="_blank">
                                <img src="../ekka-html/assets/images/products/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['name']); ?>">
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
    </section>
    <!-- Ec Instagram End -->

    <!-- Ec Brand Section Start -->
    <!-- <section class="section ec-brand-section section-space-ptb-100 section-space-mt">
        <h2 class="d-none">Brand</h2>
        <div class="container">
            <div class="row">
                <div class="ec-brand-outer">
                    <ul class="ec-brand-inner">
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/9.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/10.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/11.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/12.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/13.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/14.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/15.jpg" /></a></div>
                        </li>
                        <li class="ec-brand-item col-lg-3 col-md-4 col-sm-4">
                            <div class="ec-brand-img"><a href="#"><img alt="brand" title="برند"
                                        src="assets/images/brand-image/16.jpg" /></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Ec Brand Section End -->

    <!-- Footer Start -->
    <footer class="ec-footer">
        <div class="footer-container">
            <div class="footer-offer">
                <div class="container">
                    <!-- <div class="row">
                        <div class="text-center footer-off-msg">
                            <span>برنده مسابقه!این نسخه محدود رادریافت کنید</span><span class="footer-off-text">-
                                صندلی اداری رایگان</span><a href="#" target="_blank">نمایش جزئیات</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="footer-top section-space-footer-p">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-3 ec-footer-contact">
                            <div class="ec-footer-widget">
                                <div class="ec-footer-logo"><a href="#"><img src="assets/images/logo/footer-logo-3.png"
                                            alt=""><img class="dark-footer-logo"
                                            src="assets/images/logo/dark-logo-3.png" alt="Site Logo"
                                            style="display: none;" /></a></div>
                                <h4 class="ec-footer-heading">محل</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">یک آدرس فرضی در این محل وجود دارد</li>
                                    </ul>
                                    <div class="col-sm-12 col-lg-3 ec-footer-social">
                                        <div class="ec-footer-widget">
                                            <div class="ec-footer-links">
                                                <ul class="align-items-center">
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="ecicon eci-facebook"></i></a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="ecicon eci-twitter"></i></a>
                                                    </li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="ecicon eci-instagram"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="ecicon eci-linkedin"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3 ec-footer-news">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading"> اخبارها</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">به روز رسانی های فوری در مورد محصولات جدید و ویژه
                                            دریافت کنید!</li>
                                    </ul>
                                    <div class="ec-subscribe-form">
                                        <form id="ec-newsletter-form" name="ec-newsletter-form" method="post"
                                            action="#">
                                            <div id="ec_news_signup" class="ec-form">
                                                <input class="ec-email" type="email" required=""
                                                    placeholder="ایمیل خود را اینجا وارد کنید..." name="ec-email"
                                                    value="" />
                                                <button id="ec-news-btn" class="button btn-secondary" type="submit"
                                                    name="subscribe" value=""><i class="ecicon eci-paper-plane-o"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-account">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">اکانت</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="user-profile.html">اکانت من</a></li>
                                        <li class="ec-footer-link"><a href="track-order.html"> تاریخچه سفارش</a></li>
                                        <li class="ec-footer-link"><a href="wishlist.html"> لیست علاقه‌مندیها </a></li>
                                        <li class="ec-footer-link"><a href="offer.html">ویژه</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2 ec-footer-service">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">خدمات</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="#">تخفیف </a></li>
                                        <li class="ec-footer-link"><a href="privacy-policy.html">سیاست حریم شخصی </a>
                                        </li>
                                        <li class="ec-footer-link"><a href="#">خدمات مشتری</a></li>
                                        <li class="ec-footer-link"><a href="terms-condition.html">قوانین و شرایط</a>
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
                                        <li class="ec-footer-link"><a href="track-order.html">اطلاعات ارسال</a>
                                        </li>
                                        <li class="ec-footer-link"><a href="contact-us.html">ارتباط با ما</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Footer Copyright Start -->
                        <div class="col footer-copy">
                            <div class="footer-bottom-copy ">
                                <div class="ec-copy">کپی رایت © 1402 <a class="site-name text-upper"
                                        href="index.html">اکا</a>. همه حقوق محفوظ است</div>
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
                                    <img class="img-responsive" src="assets/images/product-image/19_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/19_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/27_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/27_2.jpg" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/19_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/19_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/27_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/27_2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html">صندلی تک برای نشیمن</a>
                                </h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>
                                <div class="ec-quickview-desc">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                                    و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و
                                    سطرآنچنان که لازم است</div>
                                <div class="ec-quickview-price">
                                    <span class="old-price">45000 تومان</span>
                                    <span class="new-price">4000 تومان</span>
                                </div>

                                <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>رنگ</span>
                                        <div class="ec-pro-variation-content">
                                            <ul>
                                                <li><span style="background-color:#696d62;"></span></li>
                                                <li><span style="background-color:#2ea1cd;"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-secondary"><img src="assets/images/icons/pro_cart.svg"
                                                class="svg_img pro_svg" alt="" />افزودن به سبد</button>
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

    <!-- FB Chat Messenger -->
    <div class="ec-fb-style fb-right-bottom">

        <!-- Start Floating Panel Container -->
        <div class="fb-panel">
            <!-- Panel Content -->
            <div class="fb-header">
                <img src="assets/images/user/1.jpg" alt="pic" />
                <h2>اریا مانا</h2>
                <p>مدیر فنی</p>
            </div>
            <div class="fb-body">
                <p><b>سلام &#128515;</b></p>
                <p> نیاز به کمک دارید؟فقط یک پیام به من بفرست</p>
            </div>
            <div class="fb-footer">

                <a href="https://m.me/Loopinfosol" target="_blank" class="fb-msg-button">
                    <span>ارسال پیام </span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </a>

            </div>
        </div>
        <!--/ End Floating Panel Container -->

        <!-- Start Right Floating Button -->
        <div class="fb-button fb-right-bottom">
            <img class="fa-messenger" src="assets/images/icons/chat-icon.png" alt="icon" />
        </div>
        <!--/ End Right Floating Button -->

    </div>
    <!-- FB Chat Messenger end -->

    <!-- Newsletter Modal Start -->
    <div id="ec-popnews-bg"></div>
    <div id="ec-popnews-box">
        <div id="ec-popnews-close"><i class="ecicon eci-close"></i></div>
        <div id="ec-popnews-box-content">
            <h1>اشتراک در خبرنامه</h1>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
            <form id="ec-popnews-form" action="#" method="post">
                <input type="email" name="newsemail" placeholder="آدرس ایمیل" required />
                <button type="button" class="btn btn-secondary" name="subscribe">اشتراک</button>
            </form>
        </div>
    </div>
    <!-- Newsletter Modal end -->

    <!-- successfully toast Start -->
    <div id="addtocart_toast" class="addtocart_toast">
        <div class="desc">شما به طور موفقیت آمیز به سبد خرید اضافه کرده اید</div>
    </div>
    <div id="wishlist_toast" class="wishlist_toast">
        <div class="desc">شما این مورد را به طور موفقیت آمیز به علاقه مندی ها اضافه کرده اید</div>
    </div>
    <!--successfully toast end -->

    <!-- Vendor JS -->
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery.notify.min.js"></script>
    <script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/countdownTimer.min.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/infiniteslidev2.js"></script>
    <script src="assets/js/plugins/fb-chat.js"></script>

    <!-- Main Js -->
    <script src="assets/js/vendor/index.js"></script>
    <script src="assets/js/demo-3.js"></script>

</body>

</html>