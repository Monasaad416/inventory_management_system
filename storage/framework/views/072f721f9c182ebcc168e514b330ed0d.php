<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المؤسسين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المؤسسين</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المؤسسين</h4>

                    <button class="btn btn-primary"><a class="x-small text-white" href="<?php echo e(route("founders.create")); ?>">إضافة مؤسس</a></button>

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
                                                <th>العنوان </th>
                                                <th>البريد الإلكتروني </th>
                                                <th>ملاحظات</th>
                                                <th>المساهمين</th>
                                                <th>تعديل</th>
                                                <th>حذف</th>
                                                <th>كشف حساب</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                    <td><?php echo e($founder->name); ?></td>
                                                    <td><?php echo e($founder->phone); ?></td>
                                                    <td><?php echo e($founder->address); ?></td>
                                                    <td><?php echo e($founder->email); ?></td>
                                                    <td>
                                                        <?php if($founder->notes  ): ?>
                                                            <?php echo e($founder->notes); ?>

                                                        <?php else: ?>
                                                            <p>لا يوجد</p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php $__currentLoopData = $founder->shareholders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shareholder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <p><?php echo e($shareholder->name); ?></p>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(route('founders.edit',$founder->id)); ?>" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث بيانات المساهم"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_founders<?php echo e($founder->id); ?>" title="حذف المساهم"><i class="fa fa-trash"></i></button></td>
                                                        <!-- Delete Modal -->
                                                        <form action="<?php echo e(route('founders.destroy',$founder)); ?>" method="POST">
                                                            <div class="modal fade" id="delete_founders<?php echo e($founder->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المساهم من قائمة المساهمين</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف المؤسس  <?php echo e($founder->name); ?></p>

                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo e(method_field('delete')); ?>

                                                                            <input type="hidden" value="<?php echo e($founder->id); ?>" name="id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <a href="<?php echo e(route('founders.balance-sheet',['id' => $founder->id])); ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
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
                            <?php echo $founders->links(); ?>

                        </div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/founders/index.blade.php ENDPATH**/ ?>