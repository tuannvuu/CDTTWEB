

<?php $__env->startSection('title', 'Chỉnh Sửa Địa Chỉ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card">
                <div class="card-header bg-transparent border-0 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="section-title mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Chỉnh Sửa Địa Chỉ
                        </h2>
                        <a href="/account" class="btn-action btn-outline">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại Profile
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="<?php echo e(route('client.shipping-addresses.update', $shippingAddress)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="fullname" name="fullname" 
                                   value="<?php echo e(old('fullname', $shippingAddress->fullname)); ?>" required>
                            <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại *</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="phone" name="phone" 
                                   value="<?php echo e(old('phone', $shippingAddress->phone)); ?>" required>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ *</label>
                            <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      id="address" name="address" rows="3" required><?php echo e(old('address', $shippingAddress->address)); ?></textarea>
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1"
                                   <?php echo e($shippingAddress->is_default ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_default">
                                Đặt làm địa chỉ mặc định
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-action btn-primary">
                                <i class="fas fa-save me-2"></i>Cập nhật Địa Chỉ
                            </button>
                        </div>
                    </form>

                    <!-- Phần xóa địa chỉ -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="text-danger mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Vùng Nguy Hiểm
                        </h5>
                        <form action="<?php echo e(route('client.shipping-addresses.destroy', $shippingAddress)); ?>" method="POST" 
                              onsubmit="return confirmDelete()">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-action btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Xóa Địa Chỉ Này
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm('Bạn có chắc chắn muốn xóa địa chỉ này? Hành động này không thể hoàn tác.');
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/client/profile/edit-address.blade.php ENDPATH**/ ?>