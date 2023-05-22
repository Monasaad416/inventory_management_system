<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تفاصيل الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة فواتير العملاء</span>
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


                            <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<div class="card-body">
								<div class="table-responsive">
                                    <h3>البيانات الأساسية للفاتورة</h3>
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>

                                                <th class="border-bottom-0">اسم العميل</th> </th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتوة</th>
												<th class="border-bottom-0">اخر موعد للدفع</th>
												

                                                <th class="border-bottom-0"> مبلغ الخصم   </th>
                                                <th class="border-bottom-0">الإجمالي  </th>
                                                <th class="border-bottom-0">حالة الفاتورة</th>
                                                <th class="border-bottom-0">ملاحظات</th>
											</tr>
										</thead>
										<tbody>

												<tr>
                                                    <td><?php echo e($invoice->user->name); ?></td>
                                                    <td><?php echo e($invoice->client_invoice_number); ?></td>
													
													<td><?php echo e($invoice->client_invoice_date); ?></td>
													<td><?php echo e($invoice->due_date); ?></td>
                                                    
													
								
                                                    <td><?php echo e($invoice->discount); ?></td>

													<td><?php echo e($invoice->total); ?></td>
													<td>
                                                        <?php if($invoice->status == 1): ?>
                                                            <span class="text-danger">غير مدفوع</span>
                                                        <?php elseif($invoice->status == 2): ?>
                                                            <span class="text-success">مدفوع</span>
                                                        <?php elseif($invoice->status == 3): ?>
                                                        <span class="text-secondary">مدفوع جزئي</span>
                                                                 <?php elseif($invoice->status == 4): ?>
                                                        <span class="text-warning">مرتجع</span>
                                                                 <?php elseif($invoice->status == 5): ?>
                                                        <span class="text-secondary">ملرتجع جزئي</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <?php if($invoice->notes): ?>
                                                    <td><?php echo e($invoice->note); ?></td>
                                                    <?php else: ?>
                                                    <td>لا يوجد</td>
                                                    <?php endif; ?>
												</tr>

										</tbody>
									</table>

                                    <h3>بنود الفاتورة</h3>
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>

                                                <th class="border-bottom-0">اسم المنتج</th> </th>
												<th class="border-bottom-0">الكمية</th>
												<th class="border-bottom-0">سعر الوحدة </th>
												<th class="border-bottom-0">أجمالي السعر  </th>
                                                <th>العمليات</th>
											</tr>
										</thead>
										<tbody>

                                            <?php $__currentLoopData = $invoice->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            

												<tr>
                                                    <td><?php echo e($product->product_name); ?></td>
                                                    <td><?php echo e($product->pivot->qty); ?></td>
                                                    <td><?php echo e($product->pivot->product_price); ?></td>

                                                    <td><?php echo e($product->pivot->total); ?></td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                            العمليات
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                            <a class="dropdown-item" href="<?php echo e(route('clients-invoice-item.edit', $product->pivot )); ?>" title="<?php echo e($product->pivot->id); ?>" >
                                                                <i class="fa fa-edit text-info mx-1" ></i>تعديل كمية البند
                                                            </a>
                                                            

                                                            <a class="dropdown-item" href="<?php echo e(route('clients-invoices-item.return.view',['item_id'=> $product->pivot->id])); ?>">
                                                                <i class="fa fa-trash text-secondary mx-1"></i>تحويل كل الكمية إلي مرتجع
                                                            </a>

                                                            <a class="dropdown-item" href="<?php echo e(route('clients-invoices-item.return.part.view',['item_id'=> $product->pivot->id])); ?>">
                                                                <i class="fa fa-trash text-danger mx-1"></i>تحويل جزء من الكمية إلي مرتجع
                                                            </a>








                                                    </td>

                                                </tr>



                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



										</tbody>
									</table>
								</div>
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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/clients-invoices/show.blade.php ENDPATH**/ ?>