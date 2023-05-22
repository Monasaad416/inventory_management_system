  <div class="row">
                <!--div-->

                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">


                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title my-3">قائمة سندات قبض العملاء</h5>
                                <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button>
                            </div>

                            <div class="row my-5">

                            <div class="col">
                                <label for="">بحث بالعميل</label>
                                <select wire:model="client_id" class="form-control" id="client_id" value="<?php echo e(old('client_id')); ?>" >
                                    <option value="">-- إختار العميل--</option>
                                    <?php $__currentLoopData = App\Models\User::where('roles_name' , '["client"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value ="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <div class="col">
                                <label for="">بحث من تاريخ</label>
                                <input type="date" wire:model="from_date" class="form-control" id="from">
                            </div>
                            <div class="col">
                                <label for="">بحث إلي تاريخ</label>
                                <input type="date" wire:model="to_date" class="form-control" id="to" >
                            </div>


                        </div>


                            <div class="table-responsive">
                                <table class="table table-hover mb-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الفاتورة</th>
                                            <th>إسم العميل </th>
                                            <th>المبلغ </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                                <td>    <?php echo e($income->client_invoice_number); ?></td>
                                                <td>    <?php echo e($income->user->name); ?></td>
                                                <td><?php echo e($income->part_paid); ?></td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
                    <div class="d-flex justify-content-center align-items-baseline">
                        <?php echo $incomes->links(); ?>

                    </div>
                <!--/div-->
            </div>
<?php /**PATH C:\laragon\www\store\resources\views/livewire/income-component.blade.php ENDPATH**/ ?>