<?php
session_start();
include('../../config/db.php'); // اتصال به دیتابیس
// اگر q خالی بود
if (!isset($_GET['q']) || trim($_GET['q']) == '') {
    echo "لطفا عبارت مورد نظر را وارد کنید.";
    exit();
}

$q = mysqli_real_escape_string($conn, $_GET['q']);

// جستجو در دیتابیس
$sql = "SELECT * FROM books WHERE name LIKE '%$q%'";
$result = mysqli_query($conn, $sql);

// تعداد نتایج
$count = mysqli_num_rows($result);

if ($count == 0) {
    echo "هیچ محصولی یافت نشد!";
    exit();
}

// اگر فقط 1 نتیجه پیدا شد → مستقیم برو صفحه جزئیات
if ($count == 1) {
    $book = mysqli_fetch_assoc($result);
    header("Location: product-full-width.php?id=" . $book['id']);
    exit();
}

// اگر چند نتیجه بود → لیست نمایش بده
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>نتایج جستجو</title>
</head>
<body>

<h2>نتایج جستجو برای: <?php echo htmlspecialchars($q); ?></h2>

<?php while ($book = mysqli_fetch_assoc($result)) { ?>

    <div style="margin-bottom:20px; border-bottom:1px solid #ccc; padding:10px;">
        <a href="product-full-width.php?id=<?php echo $book['id']; ?>">
            <img src="../ekka-html/assets/images/products/<?php echo $book['image']; ?>" width="80">
            <h3><?php echo $book['name']; ?></h3>
            <p><?php echo $book['price']; ?> تومان</p>
        </a>
    </div>

<?php } ?>

</body>
</html>