<?php $__env->startSection('title', 'Đổi mật khẩu'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Header Section -->
                <div class="page-header bg-gradient-primary rounded-3 mb-4 p-4 text-center">
                    <div class="icon-container bg-white rounded-circle p-3 d-inline-flex mb-3">
                        <i class="fas fa-lock text-primary fs-3"></i>
                    </div>
                    <h1 class="page-title text-white mb-2">Đổi mật khẩu</h1>
                    <p class="page-subtitle text-white-50 mb-0">Cập nhật mật khẩu tài khoản của bạn</p>
                </div>

                <!-- Alert Messages -->
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2 fs-5"></i>
                            <div class="flex-grow-1"><?php echo e(session('success')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
                            <div class="flex-grow-1"><?php echo e(session('error')); ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Password Change Form -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <form action="<?php echo e(route('ad.changepass')); ?>" method="POST" id="passwordChangeForm">
                            <?php echo csrf_field(); ?>

                            <!-- Current Password -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold mb-3">
                                    <i class="fas fa-key me-2 text-primary"></i>Mật khẩu hiện tại
                                </label>
                                <div class="input-group">
                                    <input type="password" name="current_password"
                                        class="form-control rounded-2 py-3 px-3 <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Nhập mật khẩu hiện tại" required>
                                    <span class="input-group-text toggle-password bg-transparent border-start-0">
                                        <i class="fas fa-eye text-muted"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="new_password" class="form-label fw-semibold mb-3">
                                    <i class="fas fa-lock me-2 text-success"></i>Mật khẩu mới
                                </label>
                                <div class="input-group">
                                    <input type="password" name="new_password"
                                        class="form-control rounded-2 py-3 px-3 <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Nhập mật khẩu mới" required>
                                    <span class="input-group-text toggle-password bg-transparent border-start-0">
                                        <i class="fas fa-eye text-muted"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label fw-semibold mb-3">
                                    <i class="fas fa-lock me-2 text-info"></i>Xác nhận mật khẩu mới
                                </label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation"
                                        class="form-control rounded-2 py-3 px-3" placeholder="Nhập lại mật khẩu mới"
                                        required>
                                    <span class="input-group-text toggle-password bg-transparent border-start-0">
                                        <i class="fas fa-eye text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Password Requirements -->
                            <div class="password-requirements bg-light rounded-2 p-3 mb-4">
                                <h6 class="fw-semibold mb-2 text-dark">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>Yêu cầu mật khẩu:
                                </h6>
                                <ul class="list-unstyled mb-0 small">
                                    <li class="text-muted mb-1">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Ít nhất 8 ký tự
                                    </li>
                                    <li class="text-muted mb-1">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Chứa ít nhất một chữ số
                                    </li>
                                    <li class="text-muted">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Chứa ít nhất một ký tự đặc biệt
                                    </li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-2 py-3 fw-semibold">
                                    <i class="fas fa-save me-2"></i>Cập nhật mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tips -->
                <div class="card bg-light border-0 rounded-3 mt-4">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold mb-3 text-dark">
                            <i class="fas fa-shield-alt me-2 text-warning"></i>Mẹo bảo mật
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted mb-3 mb-md-0">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Sử dụng mật khẩu mạnh và duy nhất
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Không sử dụng lại mật khẩu cũ
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Đổi mật khẩu định kỳ
                                    </li>
                                    <li>
                                        <i class="fas fa-check text-success me-2"></i>
                                        Không chia sẻ mật khẩu với người khác
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .icon-container {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .form-control {
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .input-group-text {
            border: 2px solid #e9ecef;
            border-left: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: #667eea;
        }

        .toggle-password:hover {
            background-color: #f8f9fa;
        }

        .password-requirements {
            border-left: 4px solid #667eea;
        }

        .alert {
            border: none;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: #28a745;
            background: linear-gradient(135deg, #d4edda 0%, #c8e6c9 100%);
        }

        .alert-danger {
            border-left-color: #dc3545;
            background: linear-gradient(135deg, #f8d7da 0%, #ffcdd2 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .list-unstyled li {
            transition: transform 0.2s ease;
        }

        .list-unstyled li:hover {
            transform: translateX(5px);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.closest('.input-group').querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Form validation enhancement
            const form = document.getElementById('passwordChangeForm');
            const inputs = form.querySelectorAll('input[type="password"]');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('has-value');
                    } else {
                        this.classList.remove('has-value');
                    }
                });
            });

            // Add loading state to submit button
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
                submitButton.disabled = true;
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/admin/users/changepass.blade.php ENDPATH**/ ?>