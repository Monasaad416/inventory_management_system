<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-header'); ?>
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
				<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا <?php echo e(Auth::user()->name); ?></h2>
				<p class="mg-b-0">لوحة تحكم العميل.</p>
			</div>
		</div>

	</div>
	<!-- /breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
    <!-- table opened -->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <!-- balance sheet button-->
                <div class=" d-inline-flex justify-content-around mt-5">
                    <div><button class="btn btn-secondary">
                         <a href="<?php echo e(route('clients.balance-sheet',['id' => $client->id])); ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب">كشف الحساب</a>
                    </button></div>
                    
                </div>
                <!-- balance sheet button-->

                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if($clientInvoices->count() > 0): ?>
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتوة</th>
                                    <th class="border-bottom-0">اخر موعد للدفع</th>
    
                                    <th class="border-bottom-0">الإجمالي </th>
                                    <th class="border-bottom-0">المدفوع </th>
                                    <th class="border-bottom-0">المتبقي </th>
                                    <th class="border-bottom-0">حالة الفاتورة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">طباعة الفاتورة</th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                    <?php $__currentLoopData = $clientInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($invoice->client_invoice_number); ?></td>
                                            <td><?php echo e($invoice->client_invoice_date); ?></td>
                                            <td><?php echo e($invoice->due_date); ?></td>
    
                                            <td><?php echo e($invoice->total); ?></td>
                                            <td><?php echo e($invoice->part_paid); ?></td>
                                             <td><?php echo e($invoice->total - $invoice->part_paid); ?></td>
                                            <td>
                                                <?php if($invoice->status == 1): ?>
                                                    <span class="text-danger">غير مدفوع</span>
                                                <?php elseif($invoice->status == 2): ?>
                                                    <span class="text-success">مدفوع</span>
                                                <?php elseif($invoice->status == 3): ?>
                                                    <span class="text-secondary">مدفوع جزئيا</span>
                                                <?php elseif($invoice->status == 4): ?>
                                                <span class="text-secondary">مرتجع</span>
                                                <?php elseif($invoice->status == 5): ?>
                                                <span class="text-secondary">مرتج جزئي</span>
                                                <?php endif; ?>
                                            </td>
                                            </td>
                                            <?php if($invoice->notes): ?>
                                            <td><?php echo e($invoice->note); ?></td>
                                            <?php else: ?>
                                            <td>لا يوجد</td>
                                            <?php endif; ?>

                                            <td><a class="dropdown-item" href="<?php echo e(route('print-client-invoice',['invoice_id'=>$invoice->id])); ?>"><i class="fa fa-print mx-1 text-purple" aria-hidden="true"></i></a></td>
                                        </tr>


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <?php else: ?>
                            <p class="text-danger">لا يوجد بيانات للعرض</p>
                        <?php endif; ?>
                    </div>
                    <?php echo $clientInvoices->links(); ?>

                </div>
            </div>
        </div>
    <!-- /table -->
    </div>
    <!-- row closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- Internal Data tables -->
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifIt.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifit-custom.js')); ?>"></script>
<!--Internal  Datatable js -->
<script src="<?php echo e(URL::asset('assets/js/table-data.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/modal.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/dashboard/client_index.blade.php ENDPATH**/ ?>