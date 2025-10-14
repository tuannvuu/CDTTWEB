<?php $__env->startSection('content'); ?>
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col mb-3">
                        <div class="card h-100 position-relative">

                            <!-- ✅ Link bao toàn bộ card -->
                            <a href="<?php echo e(route('client.products.detail', $item->id)); ?>"
                                class="stretched-link text-decoration-none text-dark">
                                <div>
                                    <img class="card-img-top" src="<?php echo e(asset('storage/products/' . $item->fileName)); ?>"
                                        alt="<?php echo e($item->proname); ?>" style="max-height:300px; object-fit:contain;" />
                                </div>

                                <div class="card-body p-2">
                                    <div class="text-center">
                                        <h4 class="fw-bolder"><?php echo e($item->proname); ?></h4>
                                    </div>
                                </div>
                            </a>

                            <!-- Footer: giá + mô tả -->
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                <?php endif; ?>
            </div>

            
            <?php if($products->hasPages()): ?>
                <style>
                    .pagination-wrapper {
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                    }

                    .pagination {
                        display: flex;
                        list-style: none;
                        gap: 6px;
                        padding: 0;
                        margin: 0;
                    }

                    .pagination li {
                        display: inline-flex;
                    }

                    .pagination a,
                    .pagination span {
                        padding: 8px 14px;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                        font-size: 14px;
                        text-decoration: none;
                        color: #007bff;
                        background: #fff;
                        transition: all 0.2s ease;
                    }

                    .pagination a:hover {
                        background: #f0f8ff;
                        border-color: #007bff;
                    }

                    .pagination .active span {
                        background: #007bff;
                        border-color: #007bff;
                        color: #fff;
                        font-weight: bold;
                    }

                    .pagination .disabled span {
                        color: #aaa;
                        background: #f9f9f9;
                        cursor: not-allowed;
                    }
                </style>

                <div class="pagination-wrapper">
                    <ul class="pagination">
                        
                        <?php if($products->onFirstPage()): ?>
                            <li class="disabled"><span>‹</span></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($products->previousPageUrl()); ?>">‹</a></li>
                        <?php endif; ?>

                        
                        <?php $__currentLoopData = $products->links()->elements[0] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $products->currentPage()): ?>
                                <li class="active"><span><?php echo e($page); ?></span></li>
                            <?php else: ?>
                                <li><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php if($products->hasMorePages()): ?>
                            <li><a href="<?php echo e($products->nextPageUrl()); ?>">›</a></li>
                        <?php else: ?>
                            <li class="disabled"><span>›</span></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views\client\categories\detail.blade.php ENDPATH**/ ?>