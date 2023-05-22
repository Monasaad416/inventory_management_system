
@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة فاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فواتير العملاء </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('inc.errors')
                    <form action="{{ route('clients-invoices.store') }}" method="post" >
                        @csrf
                        <div class="row">

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD" type="text" value="{{ old('invoice_date')}}" >
                            </div>
                            @error('invoice_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label>أخر موعد للسداد</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" type="text" value="{{ old('due_date')}}">
                            </div>
                            @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section_id" class="form-control " >
                                    <option value="0"> --إختار القسم--</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}> {{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="col">
                                <label for="inputName" class="control-label">العميل</label>
                                <select name="client_id" class="form-control">
                                    <option value="">إختر العميل</option>
                                    @foreach (App\Models\User::where('roles_name','["client"]')->get() as $client )
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                            @error('client_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="row">
                            <div class="col my-5">
                                <label for="inputName" class="control-label">المنتجات</label>


                                <div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
                                                <th>الكمية </th>
                                                <th>إخر سعر للشراء  </th>
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
                            @error('product_ids[]')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col my-2">
                                <label for="inputName" class="control-label" >مبلغ التحصيل</label>
                                <input type="number" class="form-control" id="part_paid" name="part_paid" step="any" value="{{ old('part_paid')}}">
                            </div>
                            @error('part_paid')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col my-2">
                                <label for="inputName" class="control-label">الإجمالي</label>
                                <input type="number" class="form-control form-control-lg" readonly id="totalBeforeDiscount" step="any"  >
                            </div>


                        </div>



                        <div class="row">
                            <div class="col my-2">
                                <label for="inputName" class="control-label"> مبلغ الخصم</label>
                                <input type="number" class="form-control form-control-lg" id="discount" name="discount" step="any" value="{{ old('discount',0)}}" onchange="total()">
                            </div>
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="col my-2">
                                <label for="inputName" class="control-label"> الاجمالي بعد الخصم </label>
                                <input type="number" class="form-control form-control-lg" readonly id="totalAfterDiscount" name="total" step="any" value="{{ old('total')}}">
                            </div>
                            @error('total')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>





                        <div class="row">
                            <div class="col my-2">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                            @error('note')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col my-2">
                                <label for="inputName" class="control-label"> حالة الدفع للفاتورة</label>
                                <select name="status" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" >
                                    <!--placeholder-->
                                    <option value="0" selected >--- إختار الحالة---</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }} >غير مدفوع</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }} >مدفوع</option>
                                    <option value="3" {{ old('status') == 3 ? 'selected' : '' }} >مدفوع جزئيا</option>
                                    <option value="4" {{ old('status') == 4 ? 'selected' : '' }} >مرتجع </option>
                                    <option value="5" {{ old('status') == 5 ? 'selected' : '' }} >مرتجع جزئيا</option>
                                </select>
                            </div>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div><br>



                        {{-- <p class="text-danger">* Attachment type  pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">Attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, .jpeg, .png" data-height="70" />
                        </div><br>
                        @error('file_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        --}}
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    {{-- <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/js/select2.js') }}"></script> --}}
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {

            $('select[name="section_id"]').on('change', function() {
                var sectionId = $(this).val();
               console.log(sectionId);
                if (sectionId) {
                    console.log(sectionId);
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to('/getClientsBySection') }}/" + sectionId ,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="client_id"]').empty();
                            $('select[name="client_id"]').append('<option value=""> إختار العميل ---</option>');
                            $.each(data, function(key, value) {

                            $('select[name="client_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },


                    });



                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var sectionId = $(this).val();
                //console.log(sectionId);
                if (sectionId) {
                    //console.log(sectionId);
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to('/getProdsBySection') }}/" + sectionId ,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product_ids[]"]').append('<option value=""> إختار المنتجات ---</option>');
                            $('select[name="product_ids[]"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product_ids[]"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script> --}}


    <script>

        jQuery(document).ready(function($){
            if(jQuery("#product_ids[]").data('oldid')!='' && typeof(jQuery("#product_ids[]").data('oldid'))!="undefined"){
                jQuery(".appointment_form_searchField").change();
            }
        });
        $(document).ready(function() {
            // var OldValue = '{{ old('section_id') }}';
            // if(OldValue !== '') {
            // $('#section_id').val(OldValue );

            // // this will load subcategories once you set the category value
            // $("#section_id").change();
            // }
            $('select[name="section_id"]').on('change', function() {
                var sectionId = $(this).val();
                //console.log(sectionId);
                if (sectionId) {
                    console.log(sectionId);

                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to('/getProdsBySection') }}/" + sectionId ,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            // $('select[name="product_ids[]"]').append('<option value=""> إختار المنتجات ---</option>');
                            $('.products').empty();
                            $.each(data, function(key, value) {
                                 console.log(key+1);
                                // $('.products').append('<div class="row"><div class="col-3"><input type="checkbox"  name="product_ids[]" value="' + key + '">' + value +'</div>' +  '<div class="col-9"> <label>الكمية</label><input type="number" class="form-control" name="qty[]" min="0" step="any" palceholder="الكمية"></div>'+ '</div> <hr>');
                                // $('.products').append('<tr><td><input class="checkbox" type="checkbox" name="product_ids[]" value="' + value['id'] + '"></td><td>' + value['product_name'] +'<td><input type="number" class="form-control" class="qty" name="qty[]" min="0" step="any" palceholder="الكمية"></td>' + '</td><td><input class="price form-control" readonly type="number" value="' + value['sale_price'] + '"></td><td>' + value['unit']+'</td><td>' + value['store_amount'] + '</td></tr>');
                                $('.products').append('<tr><td><input type="checkbox" class="checkbox" name="product_ids[]" value="' + value['id'] + '"></td><td>' + value['product_name'] +'<td><input type="number"  disabled class="form-control qty" name="qty[]" min="0" step="any" palceholder="الكمية"></td>' + '</td><td><input class="form-control purchase_price" readonly type="number" step="any" value="' + value['purchase_price']+'"></td><td><input class="form-control price" readonly type="number" step="any" name="sale_price[]"></td><td><input type="number" step="any" class="form-control product_total" value="0" readonly ></td></td><td><select name="unit[]" class="form-control"><option vlaue="0">إختار الوحدة</option><option vlaue="متر">متر</option><option value="كجم">كجم</option></select></td></tr>');
                            });
                        },



                    });


                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    {{-- calculate total price  --}}
    <script>
        var totalPrice = 0 ;
        var disccount = 0;
        var net = 0;
        $(document).on("change", ".checkbox", function(){
             $(this).parent().next().next().children().prop('disabled', false);
             $(this).parent().next().next().next().next().children().prop('readonly', false);

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
                        $('#totalBeforeDiscount').val(grandTotal.toFixed(2));




                            discount = parseFloat($('#discount').val(),2).toFixed(2);
                            total = parseFloat($('#totalBeforeDiscount').val(),2).toFixed(2);
                            net = total - discount;
                            $('#totalAfterDiscount').val(parseFloat(net),2).toFixed(2);


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
                    $('#totalBeforeDiscount').val(total.toFixed(2));


            } else {
                // Checkbox is unchecked, do something else
                var value = $(this).val();
                console.log('Checkbox ' + value + ' is unchecked');
            }

            $('#totalBeforeDiscount').val(totalPrice);
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
        $('.js-example-basic-multiple').select2({
            class:'form-control',
        });
    });
    </script>
@endsection

