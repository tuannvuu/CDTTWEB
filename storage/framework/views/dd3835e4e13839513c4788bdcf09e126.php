<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FUTURE NET - TẠO TÀI KHOẢN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?php echo e(asset('css/create.users.css')); ?>" rel="stylesheet" />
</head>

<body>
    <div class="particles" id="particles"></div>
    <div class="register-container">
        <div class="scan-line"></div>
        <div class="register-header">
            <div class="logo">FUTURE NET</div>
            <p class="tagline">TẠO TÀI KHOẢN</p>
        </div>

        <div class="register-body">
            <!-- Thông báo flash message -->
            <?php if(session('success')): ?>
                <div class="alert-custom alert-success-custom"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert-custom"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('ad.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="fullname" class="form-label">HỌ VÀ TÊN</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="<?php echo e(old('fullname')); ?>" placeholder="NHẬP HỌ VÀ TÊN">
                    </div>
                    <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">TÊN ĐĂNG NHẬP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo e(old('username')); ?>" placeholder="NHẬP TÊN ĐĂNG NHẬP">
                    </div>
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">ĐỊA CHỈ EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo e(old('email')); ?>" placeholder="NHẬP ĐỊA CHỈ EMAIL">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">MẬT KHẨU</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="NHẬP MẬT KHẨU">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                            style="border-color: rgba(10, 100, 255, 0.5); color: var(--neon-blue);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">XÁC NHẬN MẬT KHẨU</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="XÁC NHẬN MÃ TRUY CẬP">
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation"
                            style="border-color: rgba(10, 100, 255, 0.5); color: var(--neon-blue);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">PHÂN QUYỀN NGƯỜI DÙNG</label>
                    <select class="form-select" id="role" name="role">
                        <option value="1" <?php echo e(old('role') == '1' ? 'selected' : ''); ?>>QUẢN TRỊ VIÊN</option>
                        <option value="3" <?php echo e(old('role') == '3' ? 'selected' : ''); ?>>KHÁCH HÀNG</option>
                    </select>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-register" id="registerBtn">
                    <span id="btnText">TẠO TÀI KHOẢN</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </form>

            <div class="register-footer">
                <a href="<?php echo e(route('ad.login')); ?>">ĐÃ CÓ TÀI KHOẢN? ĐĂNG NHẬP</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tạo hiệu ứng hạt bay (particles)
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Kích thước ngẫu nhiên
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Vị trí ngẫu nhiên
                particle.style.left = `${Math.random() * 100}%`;

                // Thời gian animation ngẫu nhiên
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 10;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;

                particlesContainer.appendChild(particle);
            }
        }

        // Hiển thị / ẩn mật khẩu
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Hiển thị / ẩn xác nhận mật khẩu
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Hiển thị spinner khi gửi form
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('btnText').classList.add('d-none');
            document.getElementById('btnSpinner').classList.remove('d-none');
            document.getElementById('registerBtn').disabled = true;
        });

        // Khởi tạo hiệu ứng khi tải trang
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>

</html>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\users\create.blade.php ENDPATH**/ ?>