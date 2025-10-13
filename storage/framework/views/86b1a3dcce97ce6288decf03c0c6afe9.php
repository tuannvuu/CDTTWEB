        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Tên loại</th>
                    <th>Mô tả</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($loop->index + 1); ?></td>
                        <td><?php echo e($item->catename); ?> (<?php echo e($item->products->count()); ?> sản phẩm)
                            <button class="btn btn-sm btn-link p-0 ms-2" data-bs-toggle="collapse"
                                data-bs-target="#r<?php echo e($loop->index); ?>" aria-expanded="false"
                                aria-controls="r<?php echo e($loop->index); ?>">
                                ▼
                            </button>
                        </td>
                        <td><?php echo e($item->description); ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="<?php echo e(route('cate.edit', $item->cateid)); ?>" class="btn btn-warning mx-1">sửa</a>
                                <form action="<?php echo e(route('cate.delete', $item->cateid)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger mx-1">xóa</button>
                                </form>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#confirmdelete" data-info="<?php echo e($item->catename); ?>"
                                    data-action="<?php echo e(route('cate.delete', $item->cateid)); ?>">
                                    Xóa (modal)
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="r<?php echo e($loop->index); ?>" class="collapse">
                        <td colspan="3">
                            <ul class="mb-0">
                                <?php $__empty_1 = true; $__currentLoopData = $item->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li><?php echo e($pro->proname); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li><em>Không có sản phẩm nào</em></li>
                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($list->links('pagination::bootstrap-4')); ?>

<?php /**PATH E:\FinalAssignment_2123110231_NguyenTuanVu\resources\views\admin\order_items\list.blade.php ENDPATH**/ ?>