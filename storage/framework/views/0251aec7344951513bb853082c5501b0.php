<?php $__env->startSection('css'); ?>
    <?php $__env->startPush('css'); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة معاملة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  المعاملات المالية للمساهم</span>
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
                        

                        <form action="<?php echo e(route('shareholders_accounts.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                        <label for="inputName" class="control-label">تفاصيل المعاملة</label>
                                        <input type="text" name="notes" class="form-control" value="<?php echo e(old('notes')); ?>">
                                </div>
                                <?php $__errorArgs = ['notes'];
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
                                        <input type="number" name="amount" min="0" class="form-control" step="any" value="<?php echo e(old('amount')); ?>">
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
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">نوع المعاملة</label>
                                    <select class="form-control" name="type">
                                        <option value="0">--إختر نوع المعاملة--</option>
                                        <option value="capital" <?php echo e(old('type') == "capital" ? 'selected' : ''); ?>>مشاركة برأس  مال</option>
                                        <option value="profit"  <?php echo e(old('type') == "profit" ? 'selected' : ''); ?>>ربح</option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['type'];
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
                                    <label for="inputName" class="control-label">المؤسس</label>
                                    <?php if(auth()->user()->roles_name == ["admin"]): ?>
                                    <select class="form-control" name="user_id">
                                        <option value="0">--إختر المؤسس  --</option>
                                        <?php $__currentLoopData = App\Models\User::where('roles_name', '["founder"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($founder->id); ?>" <?php echo e(old('founder_id') == $founder->id ? 'selected' : ''); ?>><?php echo e($founder->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php elseif(auth()->user()->roles_name == ["founder"]): ?>
                                        <select class="form-control" name="user_id">
                                            <option value="0">--إختر المؤسس  --</option>
                                            <option value="<?php echo e(auth()->user()->id); ?>" <?php echo e(old('founder_id') == $founder->id ? 'selected' : ''); ?>><?php echo e(auth()->user()->name); ?></option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                                <?php $__errorArgs = ['user_id'];
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
                                    <label for="inputName" class="control-label">المساهم</label>
                                    <select class="form-control" name="shareholder_id">
                                        <option value="0">--إختر المساهم  --</option>
                                
                                    </select>
                                </div>
                                <?php $__errorArgs = ['shareholder_id'];
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
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>


                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('select[name="user_id"]').on('change', function () {
                var user_id = $(this).val();
                console.log(user_id);
                if (user_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(URL::to("getShareholdersByFounder")); ?>/" + user_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            $('select[name="shareholder_id"]').empty();
                            $('select[name="shareholder_id"]').append('<option value="selected disabled">إختر المساهم  </option>');
                            $.each(data, function (key, value) {

                                $('select[name="shareholder_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/shareholders_accounts/create.blade.php ENDPATH**/ ?>