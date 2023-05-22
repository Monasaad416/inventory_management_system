
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة فواتير <?php echo e(auth()->user()->name); ?></span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
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
                         <a href="<?php echo e(route('suppliers.balance-sheet',['id' => $supplier->id])); ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب">كشف الحساب</a>
                    </button></div>
                    
                </div>
                <!-- balance sheet button-->

                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if($supplierInvoices->count() > 0): ?>
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتوة</th>
                                    <th class="border-bottom-0">اخر موعد للدفع</th>
                                    <th class="border-bottom-0">الإجمالي </th>
                                    <th class="border-bottom-0">حالة الفاتورة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <?php $__currentLoopData = $supplierInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>

                                            <td><?php echo e($invoice->user->name); ?></td>
                                            <td><?php echo e($invoice->supplier_invoice_number); ?></td>
                                            <td><?php echo e($invoice->supplier_invoice_date); ?></td>
                                            <td><?php echo e($invoice->due_date); ?></td>
                                            <td><?php echo e($invoice->total); ?></td>
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

                                
                                        </tr>


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <?php else: ?>
                            <p class="text-danger">لا يوجد بيانات للعرض</p>    
                        <?php endif; ?>
                    </div>
                    <?php echo $supplierInvoices->links(); ?>

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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/dashboard/supplier_index.blade.php ENDPATH**/ ?>