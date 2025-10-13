<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Kết quả tìm kiếm cho: "<strong><?php echo e($keyword); ?></strong>"</h2>

        <?php if($products->isEmpty()): ?>
            <p class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 justify-content-center">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div>
                            <img class="card-img-top" src="<?php echo e(asset('storage/products/' . $item->fileName)); ?>"
                                 alt="<?php echo e($item->proname); ?>" style="max-height:300px; object-fit:contain;" />
</div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo e($item->proname); ?></h5>
                            
                            </div>

                             <div class="card-footer p-3 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <span class="text-danger fw-bold d-block mb-1">
                                        <?php echo e(number_format($item->price)); ?>đ
                                    </span>
                                    <small class="text-muted">
                                        <?php echo e(Str::limit($item->description, 50, '...')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\c#+CĐTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/client/products/search.blade.php ENDPATH**/ ?>