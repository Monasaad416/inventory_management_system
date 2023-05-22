<?php $__env->startSection('css'); ?>
    <?php $__env->startPush('css'); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل المصروف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مصروفات المورد</span>
            </div>
        </div>
 
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>
                        

                        <form action="<?php echo e(route('suppliers_expenses.update',$supplierExpense)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                           <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">تفاصيل المصروف</label>
                                    <input type="text" name="details" class="form-control" value="<?php echo e(old('details', $supplierExpense->details)); ?>">
                                </div>
                                <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                <div class="col">
                                    <label for="inputName" class="control-label">المبلغ</label>
                                    <input type="number" name="amount" min="0" class="form-control" value="<?php echo e(old('amount', $supplierExpense->amount)); ?>">
                                </div>
                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="col">
                                    <label for="inputName" class="control-label">المورد</label>
                                    <select name="supplier_id"  class="form-control" >
                                        <option> ---إختار المورد---<option>
                                            <?php $__currentLoopData = App\Models\User::where('roles_name','["supplier"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value=<?php echo e($supplier->id); ?>  <?php echo e($supplierExpense->user_id == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                </div>
                            </div>

                            <input type="hidden" name="supplier_expense_id" value="<?php echo e($supplierExpense->id); ?>">


                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/suppliers_expenses/edit.blade.php ENDPATH**/ ?>