<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">سندات قبض العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المالية </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('income-component', [])->html();
} elseif ($_instance->childHasBeenRendered('fDl74D5')) {
    $componentId = $_instance->getRenderedChildComponentId('fDl74D5');
    $componentTag = $_instance->getRenderedChildComponentTagName('fDl74D5');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fDl74D5');
} else {
    $response = \Livewire\Livewire::mount('income-component', []);
    $html = $response->html();
    $_instance->logRenderedChild('fDl74D5', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/livewire/show_income.blade.php ENDPATH**/ ?>