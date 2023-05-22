<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">

                
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
                    
                    <form action="<?php echo e(route('suppliers-invoice-item.update' , $pivotRow->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <input type="hidden" name="item_id" value="<?php echo e($pivotRow->id); ?>" >

                            <div class="col">
                                <label>تعديل كمية البند </label>
                                <input class="form-control"  type="number" step="any" name="qty" min="1"  value="<?php echo e(old('qty', $pivotRow->qty)); ?>">
                            </div>
                            <?php $__errorArgs = ['qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-secondary">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/suppliers-invoices/edit_item.blade.php ENDPATH**/ ?>