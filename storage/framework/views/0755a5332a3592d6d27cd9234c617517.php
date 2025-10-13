<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Thương hiệu - Quản lý Thương hiệu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/create.brands.css')); ?>">
</head>

<body>
    <div class="container py-4">
        <!-- Header với nút quay lại -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?php echo e(route('brand.index')); ?>" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <!-- Tiêu đề trang -->
        <div class="mb-4">
            <h1 class="page-title">Thêm Thương hiệu mới</h1>
            <p class="page-subtitle">Điền thông tin thương hiệu vào form dưới đây</p>
        </div>

        <!-- Card chứa form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Thông tin thương
                            hiệu</h5>
                    </div>
                    <div class="card-body">
                        <!-- Hiển thị thông báo -->
                        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>

                        <!-- Hiển thị lỗi validation -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <h6 class="mb-0">Vui lòng kiểm tra lại thông tin đã nhập</h6>
                                </div>
                                <ul class="mt-2 mb-0 ps-3">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form method="POST" action="<?php echo e(route('brand.store')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="f-brandname" class="form-label">
                                    Tên thương hiệu <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="brandname"
                                    class="form-control <?php $__errorArgs = ['brandname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="f-brandname"
                                    placeholder="Nhập tên thương hiệu" value="<?php echo e(old('brandname')); ?>" maxlength="100">
                                <?php $__errorArgs = ['brandname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="character-count">
                                    <span id="brandname-count">0</span>/100 ký tự
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="f-des" class="form-label">Mô tả</label>
                                <textarea name="description" id="f-des" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    rows="4" placeholder="Nhập mô tả về thương hiệu" maxlength="500"><?php echo e(old('description')); ?></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="character-count">
                                    <span id="description-count">0</span>/500 ký tự
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="<?php echo e(route('brand.index')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Thêm thương hiệu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Đếm ký tự cho các trường input
        document.addEventListener('DOMContentLoaded', function() {
            const brandnameInput = document.getElementById('f-brandname');
            const descriptionInput = document.getElementById('f-des');
            const brandnameCount = document.getElementById('brandname-count');
            const descriptionCount = document.getElementById('description-count');

            // Cập nhật số ký tự ban đầu
            brandnameCount.textContent = brandnameInput.value.length;
            descriptionCount.textContent = descriptionInput.value.length;

            // Theo dõi sự thay đổi của trường tên thương hiệu
            brandnameInput.addEventListener('input', function() {
                brandnameCount.textContent = this.value.length;
            });

            // Theo dõi sự thay đổi của trường mô tả
            descriptionInput.addEventListener('input', function() {
                descriptionCount.textContent = this.value.length;
            });

            // Tự động focus vào trường đầu tiên
            if (brandnameInput.value === '') {
                brandnameInput.focus();
            }
        });
    </script>
</body>

</html>
<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\brands\create.blade.php ENDPATH**/ ?>