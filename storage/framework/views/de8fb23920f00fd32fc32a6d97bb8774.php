<?php if(session()->has('success')): ?>
<div class="container">
    <div class="row alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
</div>    
<?php endif; ?>

<?php if(session()->has('update')): ?>
    <div class="container">
        <div class="row alert alert-info">
            <?php echo e(session('update')); ?>

        </div>
    </div>
<?php endif; ?>


<?php if(session()->has('delete')): ?>
    <div class="container">
        <div class="row alert alert-danger">
            <?php echo e(session('delete')); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\store\resources\views/inc/messages.blade.php ENDPATH**/ ?>