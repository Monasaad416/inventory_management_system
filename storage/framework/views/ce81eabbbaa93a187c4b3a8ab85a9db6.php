<?php $__env->startSection('css'); ?>
    <?php $__env->startPush('css'); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل الملف الشخصي </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الملف الشخصي</span>
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
                         <?php echo $__env->make('inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        <form action="<?php echo e(route('profile.update',$user->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">

                                <div class="col">
                                    <label>الإسم  </label><span class="text-danger">*</span>
                                    <input class="form-control" name="name"  type="text" value="<?php echo e(old('name', $user->name)); ?>">
                                </div>
                                <?php $__errorArgs = ['name'];
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
                                    <label>الهاتف</label><span class="text-danger">*</span>
                                    <input class="form-control" name="phone"type="text" value="<?php echo e(old('phone', $user->phone)); ?>">
                                </div>
                                <?php $__errorArgs = ['phone'];
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
                                    <label>البريد الإلكتروني  </label>
                                    <input class="form-control" name="email" type="email" value="<?php echo e(old('email', $user->email)); ?>">
                                </div>
                                <?php $__errorArgs = ['email'];
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
                                <div class="col my-2">
                                    <label>العنوان  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="address"><?php echo e($user->address); ?></textarea>
                                </div>
                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <div class="col my-2">
                                    <label>ملاحظات</label>
                                    <textarea class="form-control" name="notes"><?php echo e($user->notes); ?></textarea>
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
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>كلمة السر</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="كلمة السر">
                                </div>
                                <div class="col">
                                    <label>تأكيد كلمة السر</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation" placeholder="تأكيد كلمة السر">
                                </div>
                            </div>





                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" />



                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-secondary">تعديل</button>
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
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/profile/edit.blade.php ENDPATH**/ ?>