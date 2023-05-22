<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة فواتير الموردين</span>
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

							<?php if(session()->has('delete_invoice')): ?>
								<script>
									window.onload = function(){
										notif({
											message: { text: "<?php echo e(Session::get('delete_invoice')); ?>" },
											type : 'success'

									});
									}
								</script>
							<?php endif; ?>
					         <!-- add section button start-->
							<div class=" d-inline-flex justify-content-around mt-5">
								<div><button class="btn btn-primary"><a class="custom_link text-white" href="<?php echo e(route('suppliers-invoices.create')); ?>">إضافة فاتورة</a></button></div>
                                
							</div>
                            <!-- add section button end-->

                            <div class="my-5">
                                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                            </div>

							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم المورد</th> </th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتوة</th>
												<th class="border-bottom-0">اخر موعد للدفع</th>
                                                <th class="border-bottom-0">الاجمالي</th>
                                                <th class="border-bottom-0">حالة الفاتورة</th>
                                                <th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $suppliersInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e($loop->iteration); ?></td>

                                                    <td><?php echo e($invoice->user->name); ?></td>
                                                    <td><?php echo e($invoice->supplier_invoice_number); ?></td>
													<td><?php echo e($invoice->supplier_invoice_date); ?></td>
													<td><?php echo e($invoice->due_date); ?></td>                                 
													<td><?php echo e($invoice->total); ?></td>
													<td>
                                                        <?php if($invoice->status == 1): ?>
                                                            <span class="text-primary">غير مدفوع</span>
                                                        <?php elseif($invoice->status == 2): ?>
                                                            <span class="text-success">مدفوع</span>
                                                        <?php elseif($invoice->status == 3): ?>
                                                            <span class="text-secondary">مدفوع جزئيا</span>
                                                        <?php elseif($invoice->status == 4): ?>
                                                        <span class="text-danger">مرتجع</span>
                                                        <?php elseif($invoice->status == 5): ?>
                                                        <span class="text-warning">مرتج جزئي</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if($invoice->notes): ?>
                                                    <td><?php echo e($invoice->note); ?></td>
                                                    <?php else: ?>
                                                    <td>لا يوجد</td>
                                                    <?php endif; ?>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                            العمليات
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                              <a class="dropdown-item"  href="<?php echo e(route('suppliers-invoices.edit',$invoice)); ?>">
                                                                <i class="fa fa-edit text-info mx-1"></i>تعديل الفاتورة
                                                              </a>

                                                            <a class="dropdown-item"  href="<?php echo e(route('suppliers-invoices.show',$invoice)); ?>">
                                                                <i class="fa fa-eye text-secondary mx-1"></i>تفاصيل الفاتورة
                                                            </a>
                                                              <a class="dropdown-item" href="#" class="modal-effect text-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-effect="effect-flip-vertical"
                                                                data-target="#delete<?php echo e($invoice->id); ?>" title="Delete Invoice">
                                                                    <i class="fa fa-trash text-danger mx-1"></i> تحويل إلي مرتجع
                                                              </a>

                                                            <a class="dropdown-item" href="#" class="modal-effect text-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-effect="effect-flip-vertical"
                                                                data-target="#partiallyPaid<?php echo e($invoice->id); ?>" title="دفع جزء من الفاتورة">
                                                                    <i class="fas fa-money-bill-wave text-success mx-1"></i> دفع جزئي
                                                            </a>

                                                            <a class="dropdown-item" href="<?php echo e(route('print-invoice',['invoice_id'=>$invoice->id])); ?>"><i class="fa fa-print mx-1" aria-hidden="true"></i>طباعة الفاتورة</a>
                                                          </div>
                                                    </td>
												</tr>
												<!--Reteun Invoice Modal Start-->
                                                <div class="modal" id="delete<?php echo e($invoice->id); ?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">تحويل الفاتورة إلي مرتجع  </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="<?php echo e(route('suppliers-invoice.return',$invoice->id)); ?>">
                                                                                                    <?php echo csrf_field(); ?>
                                                                                                     
                                                                                                    <p class="text-danger font-weight-bold my-3">هل انت متأكد من حذف الفاتورة رقم  <?php echo e($invoice->supplier_invoice_number); ?></p>
                                                                                                    <input class="form-control" name="invoice_id" value="<?php echo e($invoice->id); ?>" type="hidden">
                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق</button>
                                                                                                        <button type="submit" class="btn btn-danger pd-x-20">حذف</button>
                                                                                                    </div>
                                                                                                    <input type="hidden" name="invoice_id" value="<?php echo e($invoice->id); ?>">
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Reteun Invoice  Modal End-->


                                                <!--Partially Paid Invoice Modal Start-->
                                                <div class="modal" id="partiallyPaid<?php echo e($invoice->id); ?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title"> دفع جزء من الفاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="<?php echo e(route('suppliers-invoice.partially-paid',$invoice->id)); ?>">
                                                                                                    <?php echo csrf_field(); ?>
                                                                                                     
                                                                                                    <p class=" font-weight-bold my-3">ادخل المبلغ الذي تم سداده  من الفاتورة رقم  <?php echo e($invoice->supplier_invoice_number); ?></p>
                                                                                                    <input class="form-control" name="invoice_id" value="<?php echo e($invoice->id); ?>" type="hidden">

                                                                                                    <input type="number" name="partially_paid"  pattern="^\d*(\.\d{0,2})?$"  step="0.01" class="form-control">
                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                                                                                                        <button type="submit" class="btn btn-primary pd-x-20">حفظ</button>
                                                                                                    </div>
                                                                                                    <input type="hidden" name="invoice_id" value="<?php echo e($invoice->id); ?>">
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Partially Paid Invoice  Modal End-->


											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
                                <?php echo $suppliersInvoices->links(); ?>

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
<script>
    $(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal);
    }
  }, 1);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/suppliers-invoices/index.blade.php ENDPATH**/ ?>