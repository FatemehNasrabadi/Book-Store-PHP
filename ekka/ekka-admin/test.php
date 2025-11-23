<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>نام</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($seller['name']); ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>ایمیل</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($seller['email']); ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>شماره تماس</label>
        <input type="text" name="mobile_number" value="<?php echo htmlspecialchars($seller['mobile_number']); ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>رمز عبور جدید (اختیاری)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>عکس پروفایل</label><br>
        <?php if (!empty($seller['profile_image'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($seller['profile_image']); ?>" width="100" style="margin-bottom:10px;">
        <?php endif; ?>
        <input type="file" name="profile_image" class="form-control">
    </div>

    <button type="submit" name="update" class="btn btn-primary">بروزرسانی اطلاعات</button>
</form>