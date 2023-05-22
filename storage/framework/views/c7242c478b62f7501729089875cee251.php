<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة فاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فواتير الموردين </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $__env->make('inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="<?php echo e(route('suppliers-invoices.store')); ?>" method="post"  id="myForm">
                    
                        <?php echo csrf_field(); ?>

                        <div class="invalid-feedback"></div> <!-- add this element to display the error message -->


                        <div class="row">

                            <div class="col my-2">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD" type="text" value="<?php echo e(old('invoice_date')); ?>" >
                            </div>
                            <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="col my-2">
                                <label>أخر موعد للسداد</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" type="text" value="<?php echo e(old('due_date')); ?>">
                            </div>
                            <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row">

                            <div class="col my-2">
                                <label for="inputName" class="control-label">المورد</label>
                                <select name="supplier_id" class="form-control">
                                    <option value="">--إختر المورد--</option>
                                    <?php $__currentLoopData = App\Models\User::where('roles_name','["supplier"]')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>> <?php echo e($supplier->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </select>
                            </div>
                            <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>


                 
                        <div class="row">
                            <div class="col my-5">
                                <label for="inputName" class="control-label">المنتجات</label>
                                <style>
                                    .select2-selection {
                                        border-color: #e1e5ef !important;
                                        padding: 20px   !important;
                                    }

                                    table, th, td {
                                        border: 1px solid #e1e5ef !important;

                                    }
                                </style>

                                <select name="product_id" class="form-control js-example-basic-single my-3 px-3" data-control="select2" >
                                    <option value="" >إختر المنتج</option>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($product->id); ?>" ><?php echo e($product->product_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>


                                <div class="table-responsive">
									<table class="table table-hover mb-0 mt-4 text-md-nowrap">
										<thead>
											<tr>
												<th class="py-2">#</th>
												<th>الإسم</th>
                                                <th>الكمية </th>
                                                <th>سعر الفاتوره</th>
                                                <th>الإجمالي</th>
                                                <th>وحدة القياس</th>
											</tr>
										</thead>
										<tbody class="products">



										</tbody>
									</table>
                                </div>
                            </div>
                            <?php $__errorArgs = ['product_ids[]'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row">
                            <div class="col my-2">
                                <label for="inputName" class="control-label" >مبلغ التحصيل</label>
                                <input type="number" class="form-control" id="part_paid" name="part_paid" step="any" value="<?php echo e(old('part_paid')); ?>">
                            </div>
                            <?php $__errorArgs = ['part_paid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="col my-2">
                                <label for="inputName" class="control-label">الإجمالي</label>
                                <input type="number" class="form-control form-control-lg" readonly id="totalBeforeDiscount" step="any"  >
                            </div>


                        </div>



                        <div class="row">
                            <div class="col my-2">
                                <label for="inputName" class="control-label"> مبلغ الخصم</label>
                                <input type="number" class="form-control form-control-lg" id="discount" name="discount" step="any" value="<?php echo e(old('discount',0)); ?>" >
                            </div>
                            <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            <div class="col my-2">
                                <label for="inputName" class="control-label"> الاجمالي بعد الخصم </label>
                                <input type="number" class="form-control form-control-lg" step="any" readonly id="totalAfterDiscount" name="total" step="any" value="<?php echo e(old('total')); ?>">
                            </div>
                            <?php $__errorArgs = ['total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>





                        <div class="row">
                            <div class="col my-2">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="col my-2">
                                <label for="inputName" class="control-label"> حالة الدفع للفاتورة</label>
                                <select name="status" class="form-control" >
                                    <!--placeholder-->
                                    <option value="0" selected >--- إختار الحالة---</option>
                                    <option value="1" <?php echo e(old('status') == 1 ? 'selected' : ''); ?> >غير مدفوع</option>
                                    <option value="2" <?php echo e(old('status') == 2 ? 'selected' : ''); ?> >مدفوع</option>
                                    <option value="3" <?php echo e(old('status') == 3 ? 'selected' : ''); ?> >مدفوع جزئيا</option>
                                    <option value="4" <?php echo e(old('status') == 4 ? 'selected' : ''); ?> >مرتجع </option>
                                    <option value="5" <?php echo e(old('status') == 5 ? 'selected' : ''); ?> >مرتجع جزئيا</option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div><br>




                        
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" id="submitForm" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- Internal Select2 js-->
    <script src="<?php echo e(URL::asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
    <!--Internal Fileuploads js-->
    <script src="<?php echo e(URL::asset('assets/plugins/fileuploads/js/fileupload.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/fileuploads/js/file-upload.js')); ?>"></script>
    <!--Internal Fancy uploader js-->
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')); ?>"></script>
    <!--Internal  Form-elements js-->
    
    
    <!--Internal Sumoselect js-->
    <script src="<?php echo e(URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')); ?>"></script>
    <!--Internal  Datepicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')); ?>"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')); ?>"></script>
    <!-- Internal form-elements js -->
    <script src="<?php echo e(URL::asset('assets/js/form-elements.js')); ?>"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

   
   <script>
        $(document).ready(function() {
            $('select[name="product_id"]').on('change', function() {
                var productId = $(this).val();
                var productName = $('select[name="product_id"] option:selected').text();
                console.log(productId);

                if (productId) {
                        $('.products').append('<tr><td><input type="checkbox" class="checkbox" name="product_ids[]" value="' + productId + '"></td><td><input type="text" class="form-control" readonly value="' + productName + '"></td><td><input type="number"  disabled class="form-control qty" name="qty[]" min="0" step="any" palceholder="الكمية"></td><td><input class="form-control price" readonly type="number" step="any" name="sale_price[]"></td><td><input type="number" step="any" class="form-control product_total" value="0" readonly ></td><td><select name="unit[]" class="form-control"><option vlaue="0">إختار الوحدة</option><option vlaue="متر">متر</option><option value="كجم">كجم</option></select></td></tr>');
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    
    <script>
        var totalPrice = 0 ;
        var disccount = 0;
        var net = 0;
        $(document).on("change", ".checkbox", function(){
            console.log( $(this).parent().next().next().next().next().children());
             $(this).parent().next().next().children().prop('disabled', false);
             $(this).parent().next().next().next().children().prop('readonly', false);

            var productId = $(this).parent().next().children().val();
            if ($(this).is(':checked')) {
                    // Checkbox is checked, do something
                    var value = $(this).val();
                    console.log('Checkbox ' + value + ' is checked');

                    var qtyInput = $(this).closest('tr').find('.qty');
                    var priceInput = $(this).closest('tr').find('.price');
                    var productTotal = $(this).closest('tr').find('.product_total');
                    var total = $('#totalBeforeDiscount').val();
                    qtyInput.add(priceInput).on('input', function() {
                        // console.log('Quantity changed to: ' + qtyInput.val());
                        // console.log('Price changed to: ' + priceInput.val());
                        productTotal.val(parseFloat(qtyInput.val() * priceInput.val()).toFixed(2));

                        // Update grand total
                        var grandTotal = 0;
                        $('.product_total').each(function() {

                            grandTotal += parseFloat($(this).val());
                            console.log(grandTotal);
                        });
                        $('#totalBeforeDiscount').val(parseFloat(grandTotal).toFixed(2));




                            discount = parseFloat($('#discount').val(),2).toFixed(2);
                            total = parseFloat($('#totalBeforeDiscount').val()).toFixed(2);
                            net = total - discount;
                            $('#totalAfterDiscount').val(parseFloat(net).toFixed(2));


                    });

                    // Loop through each row to accumulate total
                    var total = 0;
                    $('tr').each(function() {
                        var row = $(this);
                        var qty = parseFloat(row.find('.qty').val());
                        var price = parseFloat(row.find('.price').val());
                        var subtotal = qty * price;
                        row.find('.total').val(subtotal.toFixed(2));
                        total += subtotal;
                    });
                    $('#totalBeforeDiscount').val(parseFloat(total).toFixed(2));


            } else {

                    $(this).parent().next().next().children().prop('disabled', true);
                    $(this).parent().next().next().children().val(0);
                    $(this).parent().next().next().next().children().prop('readonly', true);
                    $(this).parent().next().next().next().children().val(0);
                    $(this).parent().next().next().next().next().children().val(0);
                    $(this).parent().next().next().next().next().next().children().val(null);



                    // Update grand total
                    var grandTotal = 0;
                    $('.product_total').each(function() {

                        grandTotal += parseFloat($(this).val());
                        console.log(grandTotal);
                    });
                    $('#totalBeforeDiscount').val( parseFloat(grandTotal).toFixed(2));



                    //adhust discount after uncheck item
                    discount = parseFloat($('#discount').val()).toFixed(2);
                    total = parseFloat($('#totalBeforeDiscount').val()).toFixed(2);
                    net = total - discount;
                    $('#totalAfterDiscount').val(parseFloat(net)).toFixed(2);
            }


       });




        $(document).on('input', '#discount', function(){
            discount = parseFloat($('#discount').val(),2).toFixed(2);
            total = parseFloat($('#totalBeforeDiscount').val(),2).toFixed(2);
            net = total - discount;
            $('#totalAfterDiscount').val(parseFloat(net),2).toFixed(2);

        });




    </script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\store\resources\views/pages/suppliers-invoices/create.blade.php ENDPATH**/ ?>