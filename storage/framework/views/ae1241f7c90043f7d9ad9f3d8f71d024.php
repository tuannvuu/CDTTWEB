<?php $__env->startSection('title', 'Sản phẩm - Cập nhật'); ?>

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/edit.pro.css')); ?>" rel="stylesheet" />

<div class="container-fluid py-4">
    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-edit"></i> Cập nhật sản phẩm</h2>
            <span class="product-id">ID: <?php echo e($product->id); ?></span>
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

        <!-- Thông tin sản phẩm -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Ngày tạo</div>
                <div class="info-value">
                    <?php echo e($product->created_at ? $product->created_at->format('d/m/Y H:i') : 'N/A'); ?>

                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Lần cập nhật cuối</div>
                <div class="info-value">
                    <?php echo e($product->updated_at ? $product->updated_at->format('d/m/Y H:i') : 'N/A'); ?>

                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Danh mục</div>
                <div class="info-value"><?php echo e($product->category->catename ?? 'N/A'); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Thương hiệu</div>
                <div class="info-value"><?php echo e($product->brand->brandname ?? 'N/A'); ?></div>
            </div>
        </div>

        <!-- ✅ Form chính duy nhất -->
        <form id="productForm" action="<?php echo e(route('ad.pro.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> Vui lòng kiểm tra lại thông tin</h5>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-1">• <?php echo e($item); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <!-- Thông tin cơ bản -->
            <div class="form-section">
                <h5><i class="fas fa-info-circle"></i> Thông tin cơ bản</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="proname" class="form-label required">Tên sản phẩm</label>
                        <input type="text" name="proname" class="form-control" id="proname"
                            value="<?php echo e(old('proname', $product->proname)); ?>" required placeholder="Nhập tên sản phẩm">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label required">Giá sản phẩm (VND)</label>
                        <div class="input-group">
                            <input type="number" name="price" class="form-control" id="price"
                                value="<?php echo e(old('price', $product->price)); ?>" required step="1000" min="0"
                                placeholder="Nhập giá sản phẩm">
                            <span class="input-group-text">₫</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brandid" class="form-label required">Thương hiệu</label>
                        <select name="brandid" id="brandid" class="form-select" required>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>"
                                    <?php echo e(old('brandid', $product->brandid) == $brand->id ? 'selected' : ''); ?>>
                                    <?php echo e($brand->brandname); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cateid" class="form-label required">Danh mục</label>
                        <select name="cateid" id="cateid" class="form-select" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->cateid); ?>"
                                    <?php echo e(old('cateid', $product->cateid) == $category->cateid ? 'selected' : ''); ?>>
                                    <?php echo e($category->catename); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="form-section">
                <h5><i class="fas fa-align-left"></i> Mô tả sản phẩm</h5>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả chi tiết</label>
                    <textarea name="description" id="description" rows="5" class="form-control"
                        placeholder="Nhập mô tả chi tiết về sản phẩm"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>
            </div>

            <!-- Hình ảnh sản phẩm -->
            <div class="form-section">
                <h5><i class="fas fa-image"></i> Hình ảnh sản phẩm</h5>

                <?php
                    $imagePath = null;
                    if ($product->fileName && file_exists(public_path('storage/products/' . $product->fileName))) {
                        $imagePath = 'storage/products/' . $product->fileName;
                    }
                ?>

                <?php if($imagePath): ?>
                    <div class="current-image">
                        <div class="image-badge">Ảnh hiện tại</div>
                        <img src="<?php echo e(asset($imagePath)); ?>" alt="<?php echo e($product->proname); ?>">
                        <div class="mt-2 text-muted">Kích thước:
                            <?php echo e(round(filesize(public_path($imagePath)) / 1024, 1)); ?> KB</div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Sản phẩm chưa có hình ảnh
                    </div>
                <?php endif; ?>

                <!-- Upload ảnh mới -->
                <div class="file-upload mb-3">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h5>Chọn ảnh mới để thay thế (tùy chọn)</h5>
                    <p class="text-muted">Hỗ trợ: JPG, PNG, GIF - Kích thước tối đa: 5MB</p>
                    <input type="file" name="fileName" id="fileName" class="d-none" accept="image/*">
                    <button type="button" class="btn btn-warning"
                        onclick="document.getElementById('fileName').click()">
                        <i class="fas fa-sync-alt me-2"></i> Chọn ảnh mới
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
                    <img id="imagePreview" class="preview-image" alt="Xem trước hình ảnh mới">
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="action-buttons">
                <div>
                    <a href="<?php echo e(route('ad.pro.index')); ?>" class="btn btn-success">
                        <i class="fas fa-arrow-left me-2"></i> Quay lại
                    </a>
                    <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                        <i class="fas fa-redo me-2"></i> Đặt lại
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Cập nhật sản phẩm
                </button>
            </div>
            
        </form>
    </div>
</div>

<script>
    // Xem trước hình ảnh mới
    document.getElementById('fileName').addEventListener('change', function(e) {
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

    // Reset form
    function resetForm() {
        if (confirm('Bạn có chắc muốn đặt lại tất cả thay đổi?')) {
            document.getElementById('productForm').reset();
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('fileName').value = '';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\products\edit.blade.php ENDPATH**/ ?>