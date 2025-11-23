<?php
include('../../config/db.php'); // اتصال به دیتابیس

// گرفتن همه محصولات از جدول books
$sql = "SELECT * FROM books ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// بررسی اینکه محصولی وجود دارد یا خیر
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        // چاپ کارت محصول (مثال ساده)
        echo '<div class="product-card">';
        echo '<img src="assets/images/products/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p>قیمت: ' . htmlspecialchars($row['price']) . '</p>';
        echo '<p>تخفیف: ' . htmlspecialchars($row['discount']) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>هیچ محصولی موجود نیست.</p>';
}
?>