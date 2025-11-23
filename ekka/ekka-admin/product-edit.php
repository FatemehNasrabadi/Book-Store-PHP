<?php
include('../../config/db.php'); // اتصال به دیتابیس


// بررسی اینکه آی‌دی محصول در URL هست
if(isset($_GET['id'])){
    $id = intval($_GET['id']); // گرفتن ID محصول و تبدیل به عدد

    // گرفتن اطلاعات محصول از دیتابیس
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $product = mysqli_fetch_assoc($result); // آرایه اطلاعات محصول
    } else {
        die("محصول یافت نشد.");
    }
} else {
    die("آی‌دی محصول مشخص نشده.");
}

// اگر فرم ارسال شد، اطلاعات را به‌روزرسانی کن
if(isset($_POST['submit'])){
    // گرفتن مقادیر فرم
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $status = isset($_POST['status']) ? 1 : 0;
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // اگر تصویر جدید آپلود شد، جایگزین کن
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $image_name = time() . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../ekka-html/assets/images/products/".$image_name);
    } else {
        $image_name = $product['image']; // تصویر قبلی
    }

    // به‌روزرسانی محصول در دیتابیس
    $sql_update = "UPDATE books SET 
        name='$name',
        price='$price',
        quantity='$quantity',
        discount='$discount',
        status='$status',
        category='$category',
        description='$description',
        image='$image_name'
        WHERE id=$id";

    if(mysqli_query($conn, $sql_update)){
        echo "محصول با موفقیت به‌روزرسانی شد!";
        // ریدایرکت بعد از ۲ ثانیه به لیست محصولات
        echo '<meta http-equiv="refresh" content="2;url=product-list.php">';
    } else {
        echo "خطا در به‌روزرسانی: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <div class="card shadow rounded-lg">
        <!-- هدر کارت -->
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">ویرایش محصول</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <!-- ستون اول: نام و قیمت -->
                    <div class="col-md-6">
                        <label class="form-label">نام محصول:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">قیمت:</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <!-- ستون دوم: تعداد و تخفیف -->
                    <div class="col-md-6">
                        <label class="form-label">تعداد:</label>
                        <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">تخفیف:</label>
                        <input type="number" name="discount" class="form-control" value="<?php echo $product['discount']; ?>" required>
                    </div>
                    <!-- دسته‌بندی -->
                    <div class="col-md-12">
                        <label class="form-label">دسته‌بندی:</label>
                        <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>" required>
                    </div>
                    <!-- توضیحات -->
                    <div class="col-md-12">
                        <label class="form-label">توضیحات:</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    <!-- وضعیت فعال/غیرفعال -->
                    <div class="col-md-12 form-check mb-3">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck" <?php if($product['status']) echo 'checked'; ?>>
                        <label class="form-check-label" for="statusCheck">فعال</label>
                    </div>
                    <!-- تصویر محصول -->
                    <div class="col-md-12">
                        <label class="form-label">تصویر محصول:</label>
                        <input type="file" name="image" class="form-control mb-2">
                        <div class="mt-2">
                            <img src="../ekka-html/assets/images/products/<?php echo $product['image']; ?>" class="img-thumbnail shadow-sm" width="200" alt="تصویر فعلی">
                        </div>
                    </div>
                    <!-- دکمه ارسال -->
                    <div class="col-md-12 mt-3">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg shadow-sm">
                            به‌روزرسانی محصول
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>