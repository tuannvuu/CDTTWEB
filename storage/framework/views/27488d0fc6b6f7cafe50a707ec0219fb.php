

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="fw-bold mb-4">Tất cả danh mục</h2>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <a href="<?php echo e(route('category', ['id' => $item->cateid])); ?>" 
                   class="text-decoration-none text-center d-block p-3 shadow-sm rounded-4 h-100">
                    <?php
                        $imagePath = 'storage/categories/' . $item->cateimage;
                    ?>
                    <?php if($item->cateimage && file_exists(public_path($imagePath))): ?>
                        <img src="<?php echo e(asset($imagePath)); ?>" 
                             alt="<?php echo e($item->catename); ?>" 
                             class="img-fluid mb-2 rounded-3" 
                             style="max-height:80px; object-fit:contain;">
                    <?php else: ?>
                        <img src="<?php echo e(asset('storage/categories/default.jpg')); ?>" 
                             alt="Ảnh mặc định" 
                             class="img-fluid mb-2 rounded-3" 
                             style="max-height:80px; object-fit:contain;">
                    <?php endif; ?>

                    <span class="fw-bold text-dark"><?php echo e($item->catename); ?></span>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- ✅ Phân trang -->
    <div class="mt-4 d-flex justify-content-center">
        <?php echo e($categories->links()); ?>      
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\categories\all.blade.php ENDPATH**/ ?>