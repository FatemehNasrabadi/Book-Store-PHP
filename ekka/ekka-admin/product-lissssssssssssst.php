<?php
include('../../config/db.php'); // اتصال به دیتابیس 


// گرفتن همه محصولات از جدول books
$sql = "SELECT * FROM books ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo '<tr>';
        // echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td><img src="../ekka-html/assets/images/products/' . htmlspecialchars($row['image']) . '" width="50" alt="کتاب"></td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['price']) . '</td>';
        echo '<td>' . htmlspecialchars($row['discount']) . '</td>';
        echo '<td>' . htmlspecialchars($row['sold_count']) . '</td>';
        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
        echo '<td>' . ($row['status'] ? 'فعال' : 'غیرفعال') . '</td>';
        echo '<td>' . $row['created_at'] . '</td>';
        echo '<td>
                <a href="product-edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary">ویرایش</a>
                <a href="product-delete.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger">حذف</a>
              </td>';
        echo '</tr>';
    }
}
 else {
    echo '<tr><td colspan="10">داده‌ای در جدول وجود ندارد</td></tr>';
}

?>

