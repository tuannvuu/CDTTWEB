<?php $__env->startSection('title', 'Sản phẩm - Thêm'); ?>

<?php $__env->startSection('content'); ?>
    
<link href="<?php echo e(asset('css/create.pro.css')); ?>" rel="stylesheet" />
    <div class="container-fluid py-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-plus-circle"></i>Thêm sản phẩm mới</h2>
            </div>

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

            <form action="<?php echo e(route('pro.store')); ?>" method="POST" enctype="multipart/form-data" id="productForm">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle"></i>Vui lòng kiểm tra lại thông tin</h5>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-1">• <?php echo e($item); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <!-- Thông tin cơ bản -->
                <div class="form-section">
                    <h5><i class="fas fa-info-circle"></i>Thông tin cơ bản</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f-proname" class="form-label required">Tên sản phẩm</label>
                            <input type="text" name="proname" class="form-control" id="f-proname"
                                value="<?php echo e(old('proname')); ?>" required placeholder="Nhập tên sản phẩm">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="f-price" class="form-label required">Giá sản phẩm (VND)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control" id="f-price"
                                    value="<?php echo e(old('price')); ?>" required step="1000" min="0"
                                    placeholder="Nhập giá sản phẩm">
                                <span class="input-group-text">₫</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="f-brandid" class="form-label required">Thương hiệu</label>
                            <select name="brandid" id="f-brandid" class="form-select" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brand->id); ?>"
                                        <?php echo e(old('brandid') == $brand->id ? 'selected' : ''); ?>>
                                        <?php echo e($brand->brandname); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="f-cateid" class="form-label required">Danh mục</label>
                            <select name="cateid" id="f-cateid" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->cateid); ?>"
                                        <?php echo e(old('cateid') == $category->cateid ? 'selected' : ''); ?>>
                                        <?php echo e($category->catename); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="form-section">
                    <h5><i class="fas fa-align-left"></i>Mô tả sản phẩm</h5>

                    <div class="mb-3">
                        <label for="f-des" class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" id="f-des" rows="5" class="form-control"
                            placeholder="Nhập mô tả chi tiết về sản phẩm"><?php echo e(old('description')); ?></textarea>
                        <div class="form-text">Mô tả giúp khách hàng hiểu rõ hơn về sản phẩm của bạn.</div>
                    </div>
                </div>

                <!-- Hình ảnh sản phẩm -->
                <div class="form-section">
                    <h5><i class="fas fa-image"></i>Hình ảnh sản phẩm</h5>

                    <div class="file-upload mb-3">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h5>Kéo thả hình ảnh hoặc click để chọn</h5>
                        <p class="text-muted">Hỗ trợ: JPG, PNG, GIF - Kích thước tối đa: 5MB</p>
                        <input type="file" name="fileName" id="f-path" class="d-none" accept="image/*">
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('f-path').click()">
                            <i class="fas fa-folder-open me-2"></i>Chọn hình ảnh
                        </button>
                    </div>

                    <?php $__errorArgs = ['fileName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-2">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <div class="preview-container">
                        <img id="imagePreview" class="preview-image" alt="Xem trước hình ảnh">
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="action-buttons">
                    <a href="<?php echo e(route('pro.index')); ?>" class="btn btn-success">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Xem trước hình ảnh
        document.getElementById('f-path').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        // Format giá tiền khi nhập
        document.getElementById('f-price').addEventListener('input', function(e) {
            const value = e.target.value;
            if (value) {
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                e.target.value = formatted.replace(/,/g, '');
            }
        });

        // Hiển thị giá trị đã format khi load trang
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('f-price');
            if (priceInput.value) {
                const value = priceInput.value;
                const formatted = new Intl.NumberFormat('vi-VN').format(value);
                priceInput.value = formatted.replace(/,/g, '');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\products\create.blade.php ENDPATH**/ ?>