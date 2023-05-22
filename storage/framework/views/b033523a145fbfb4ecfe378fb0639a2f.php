<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحويل البند إلي مرتجع </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فواتير العملاء </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <form action="<?php echo e(route('clients-invoices-item.return',$pivotRow->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        

                        <input type="hidden" name="item_id" value="<?php echo e($pivotRow->id); ?>">

                        <div class="row">

                        <h5>هل انت متأكد من تحويل البند إلي مرتجع وإعادتة إلي رصيد المخزن.؟</h5>

                        </div>




                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-danger">تحويل إلي مرتجع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/clients-invoices/return-item.blade.php ENDPATH**/ ?>