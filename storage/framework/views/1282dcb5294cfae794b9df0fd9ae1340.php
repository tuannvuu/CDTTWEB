<button class="btn btn-menu-cate me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"
    id="categoryDropdown">
    <i class="bi bi-list" style="font-size:2rem;"></i>
</button>

<ul class="dropdown-menu custom-category-dropdown" aria-labelledby="categoryDropdown">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('category', ['id' => $item->cateid])); ?>">
                <img src="<?php echo e(asset('storage/categories/' . $item->image)); ?>"
                     alt="<?php echo e($item->catename); ?>"
                     class="category-icon img-fluid"
                     style="max-height:70px; object-fit:contain;">
                <span class="ms-2 category-name"><?php echo e($item->catename); ?></span>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\testCDTT\FinalAssignment_2123110231_NguyenTuanVu\resources\views/components/category-menu.blade.php ENDPATH**/ ?>