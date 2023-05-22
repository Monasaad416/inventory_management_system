<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المساهمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  قائمة المساهمين للمؤسس  <?php echo e(auth()->user()->name); ?></span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->

    <!-- table opened -->
				<!-- row opened -->
				<div class="row ">
					<!--div-->

                    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المساهمين</h4>

                    

								</div>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
												<th>الهاتف </th>
                                                <th>عدد الاسهم </th>
                                                <th>قيمة السهم</th>
                                                <th>ملاحظات</th>
                                                <th>كشف حساب</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $__currentLoopData = $shareholders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shareholder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                    <td><?php echo e($shareholder->name); ?></td>
                                                    <td><?php echo e($shareholder->phone); ?></td>

                                                    <td>
                                                        <?php if($shareholder->shares  ): ?>
                                                            <?php echo e($shareholder->shares); ?>

                                                        <?php else: ?>
                                                            <p>لا يوجد</p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($shareholder->share_value); ?></td>
                                                    <td>
                                                        <?php if($shareholder->notes  ): ?>
                                                            <?php echo e($shareholder->notes); ?>

                                                        <?php else: ?>
                                                            <p>لا يوجد</p>
                                                        <?php endif; ?>
                                                    </td>
                                          
            

                                                    <td>
                                                        <a href="<?php echo e(route('shareholders.balance-sheet',['id' => $shareholder->id])); ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                    </td>



                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>


							</div>
						</div>
					</div>
                       <div class="d-flex justify-content-center align-items-baseline">
                            <?php echo $shareholders->links(); ?>

                        </div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
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

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/dashboard/founder_index.blade.php ENDPATH**/ ?>