<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu</title>
    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="container mt-3 ">
        <form action="<?php echo e(route('ad.reset', $user->id)); ?>" method="POST"
            class="mx-auto shadow-lg p-4 w-50 bg-light rounded">
            <?php echo csrf_field(); ?>
            <h2 class="mb-4 text-center">Đặt lại mật khẩu</h2>
            <p class="text-center text-muted">Tài khoản: <strong><?php echo e($user->email); ?></strong></p>

            
            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Cập nhật mật khẩu</button>

            <div class="text-end mt-2">
                <a href="<?php echo e(route('ad.login')); ?>">Quay lại đăng nhập</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\users\resetpass.blade.php ENDPATH**/ ?>