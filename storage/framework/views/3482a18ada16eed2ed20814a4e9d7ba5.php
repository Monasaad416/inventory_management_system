<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("supplier")): ?>
    <div class="row">
        <!--div-->
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title my-3">  المراجعة المالية للمورد</h5>
                        
                    </div>

                    <div class="row my-5">

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
                        <table id="example1" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">البند  </th>
                                            <th class="border-bottom-0"> المبلغ (جنية) </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <th class="border-bottom-0">إجمالي فواتير الشراء </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($purchases,2)); ?> </th>
                                        </tr>
                                        <?php
                                            $outcomes = App\Models\Outcome::where( function($query) {
                                            if(!empty($this->from_date) && !empty($this->to_date)  ){
                                                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                                            }
                                        })->where('outcomable_type','App\Models\User')->where('outcomable_id',auth()->user()->id)->sum('amount');

                                        ?>
                                        <tr>
                                            <th class="border-bottom-0">مصروفات  </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($outcomes,2)); ?> </th>
                                        </tr>


                                        <tr>
                                            <th class="border-bottom-0">دفعات  للمورد </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($part_paid_purchases,2)); ?> </th>
                                        </tr>
                                        <?php
                                        $rest = $purchases - $outcomes - $part_paid_purchases;
                                        ?>


                                        <tr>
                                            <th class="border-bottom-0">المبلغ المتبقي للمورد  </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($rest,2)); ?> </th>
                                        </tr>

                                        <tr>
                                            <th class="border-bottom-0">المرتجع</th>
                                            <th class="border-bottom-0"><?php echo e(number_format($returnedItems,2)); ?> </th>
                                        </tr>



                                    </tbody>
                                </table>
                    </div>


                </div>
            </div>
        </div>
        
        <!--/div-->
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("client")): ?>
        <div class="row">
        <!--div-->
        <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title my-3">  المراجعة المالية للعميل</h5>
                        
                    </div>

                    <div class="row my-5">

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
                        <table id="example1" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">البند  </th>
                                            <th class="border-bottom-0"> المبلغ (جنية) </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <th class="border-bottom-0">إجمالي فواتير البيع </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($sales,2)); ?> </th>
                                        </tr>



                                        <tr>
                                            <th class="border-bottom-0">دفعات  للعميل </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($clientsPayments,2)); ?> </th>
                                        </tr>


                                        <?php
                                            $rest = $sales - $clientsPayments;
                                        ?>
                                        <tr>
                                            <th class="border-bottom-0">المبلغ المتبقي للعميل  </th>
                                            <th class="border-bottom-0"><?php echo e(number_format($rest,2)); ?> </th>
                                        </tr>

                                        <tr>
                                            <th class="border-bottom-0">المرتجع</th>
                                            <th class="border-bottom-0"><?php echo e(number_format($returnedItems,2)); ?> </th>
                                        </tr>




                                    </tbody>
                                </table>
                    </div>


                </div>
            </div>
        </div>
        
        <!--/div-->
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
  <div class="row">
    <!--div-->
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3"> المراجعة المالية</h5>
                    
                </div>

                <div class="row my-5">

                

                <?php if(auth()->user()->roles_name == ["admin"]): ?>
                <div class="col">
                    <label for="">بحث بالمؤسس</label>
                    <select wire:model="user_id" class="form-control" >
                        <option value="">-- إختار المؤسس--</option>
                        <?php $__currentLoopData = App\Models\User::where('roles_name','["founder"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value ="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>

               <div class="col">
                    <label for="">بحث بالعميل</label>
                    <select wire:model="client_id" class="form-control" id="client_id" value="<?php echo e(old('client_id')); ?>" >
                        <option value="">-- إختار العميل--</option>
                        <?php $__currentLoopData = App\Models\User::where('roles_name','["client"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="border-bottom-0">إجمالي فواتير البيع </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($sales,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">إجمالي فواتير الشراء </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($purchases,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">مصروفات  </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($outcomes,2)); ?> </th>
                                    </tr>



                                     <tr>
                                        <th class="border-bottom-0">دفعات من العملاء </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($clientsPayments,2)); ?> </th>
                                    </tr>


                                     <tr>
                                        <th class="border-bottom-0">دفعات  للموردين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($part_paid_purchases,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهمين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($sharesValue,2)); ?> </th>
                                    </tr>
                                    <tr>
                                        <th> ربح المؤسسين</th>
                                        
                                        <th><?php echo e(number_format($foundersValue,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهمين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($shareholdersPayments,2)); ?> </th>
                                    </tr>
                                    <tr>
                                        <th> دفعات المؤسسين</th>
                                        <th class="border-bottom-0"><?php echo e(number_format($foundersPayments,2)); ?> </th>
                                    </tr>



                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    
    <!--/div-->
</div>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('founder')): ?>
  <div class="row">
    <!--div-->
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3">  المراجعة المالية للمؤسس <?php echo e(auth()->user()->id); ?></h5>
                    
                </div>

                <div class="row my-5">

                



               <div class="col">
                    <label for="">بحث بالمساهم</label>
                    <select wire:model="shareholder_id" class="form-control" id="shareholder_id" value="<?php echo e(old('shareholder_id')); ?>" >
                        <option value="">-- إختار المساهم--</option>
                        <?php $__currentLoopData = App\Models\User::where('roles_name','["shareholder"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shareholder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value ="<?php echo e($shareholder->id); ?>"><?php echo e($shareholder->name); ?></option>
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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهمين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($sharesValue,2)); ?> </th>
                                    </tr>
                                    <tr>
                                        <th> ربح المؤسس</th>
                                        
                                        <th><?php echo e(number_format($foundersValue,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهمين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($shareholdersPayments,2)); ?> </th>
                                    </tr>
                                    <tr>
                                        <th> دفعات المؤسسين</th>
                                        <th class="border-bottom-0"><?php echo e(number_format($foundersPayments,2)); ?> </th>
                                    </tr>


                                    <tr>
                                        <th class="border-bottom-0">المتبقي من دفعات المساهمين </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($shareholdersRest,2)); ?> </th>
                                    </tr>
                                    <tr>
                                        <th> المتبقي من دفعات المؤسسين</th>
                                        <th class="border-bottom-0"><?php echo e(number_format($foundersRest,2)); ?> </th>
                                    </tr>
                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    
    <!--/div-->
</div>
<?php endif; ?>



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shareholder')): ?>
  <div class="row">
    <!--div-->
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3">  المراجعة المالية للمساهم <?php echo e(auth()->user()->id); ?></h5>
                    
                </div>

                <div class="row my-5">

                



                

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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهم </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($sharesValue,2)); ?> </th>
                                    </tr>


                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهم </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($shareholderPayments,2)); ?> </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">المتبقي من دفعات المساهم </th>
                                        <th class="border-bottom-0"><?php echo e(number_format($shareholderRest,2)); ?> </th>
                                    </tr>
                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    
    <!--/div-->
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\store\resources\views/livewire/financial-component.blade.php ENDPATH**/ ?>