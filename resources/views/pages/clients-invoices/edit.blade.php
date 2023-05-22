
@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل فاتورة رقم {{$invoice->client_invoice_number}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فواتير العملاء </span>
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
                {{-- @include('inc.errors') --}}
                <form action="{{ route('clients-invoices.update' ,$invoice) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id}}" >

                        <div class="col my-2">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD" type="text" value="{{ old('client_invoice_date', $invoice->client_invoice_date) }}">
                        </div>
                        @error('invoice_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="col my-2">
                            <label>أخر موعد للسداد</label>
                            <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD" value="{{ old('due_date', $invoice->due_date) }}"type="text">
                        </div>
                        @error('due_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col my-2">
                            <label for="inputName" class="control-label">العميل</label>
                            <select name="client_id" class="form-control">
                                @foreach ($clients as $client)
                                    @if( $client->id == $invoice->user->id )
                                <option selected value="{{$client->id}}">{{ $client->name }}</option>
                                @endif

                                @endforeach


                            </select>
                        </div>
                        @error('client_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- replace(/(\..*)\./g, '$1');"> replace anything that is not number with nothing --}}
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
                                @foreach ($products as $product )

                                    <option value="{{ $product->id }}" >{{$product->product_name}}</option>
                                @endforeach
                            </select>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الإسم</th>
                                            <th>الكمية </th>
                                            <th>سعر الفاتوره</th>
                                            <th>الإجمالي</th>
                                            <th>وحدة القياس</th>
                                        </tr>
                                    </thead>

                                    <tbody class="products">
                                        @foreach ($invoice->products as $prod)
                                            @php
                                                $pivotRow = DB::table('client_invoice_product')->where('product_id', $prod->id)->where('client_invoice_id',$invoice->id)->first();
                                                $prodIds =  DB::table('client_invoice_product')->where('client_invoice_id', $invoice->id)->pluck('product_id')->toArray();
                                            @endphp
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="checkbox"  value="{{ $prod->id }}" name="product_ids[]" checked>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="name" class="form-control"  readonly value="{{$prod->product_name}}">
                                                    </td>

                                                    <td>
                                                        <input type="number" step="any" class="form-control qty" data-quantity="{{$pivotRow->qty}}"  name="qty[]" min="0" step="any" value="{{$pivotRow->qty}}">
                                                    </td>

                                                    <td><input type="number" step="any" value="{{$pivotRow->product_price}}" name="sale_price[]" class="form-control price"></td>
                                                    <td><input type="number" step="any" class="form-control product_total" value="{{ $pivotRow->product_price * $pivotRow->qty }}" readonly></td>
                                                    <td>
                                                        <select name="unit[]" class="form-control">
                                                            <option value="">إختار الوحدة</option>
                                                            <option value="متر" {{ $pivotRow->unit == 'متر' ? 'selected' : '' }}>متر</option>
                                                            <option value="كجم" {{ $pivotRow->unit == 'كجم' ? 'selected' : '' }}>كجم</option>
                                                        </select>
                                                    </td>


                                                </tr>



                                        @endforeach

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
                            <input type="number" class="form-control" id="part_paid" name="part_paid" step="any" value="{{ old('part_paid',$invoice->part_paid)}}">
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
                            <input type="number" class="form-control form-control-lg" id="discount" name="discount" step="any" value="{{ old('discount',$invoice->discount)}}" onchange="total()">
                        </div>
                        @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="col my-2">
                            <label for="inputName" class="control-label"> الاجمالي بعد الخصم </label>
                            <input type="number" class="form-control form-control-lg" readonly id="totalAfterDiscount" name="total" step="any" value="{{ old('total',$invoice->total)}}">
                        </div>
                        @error('total')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="row">


                        <div class="col">
                        <label for="exampleTextarea">ملاحظات</label>
                        <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoice->note }}</textarea>
                        </div>
                        @error('note')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="col">
                            <label for="inputName" class="control-label">تحديث حالة الدفع للفاتورة</label>
                            <select name="status" class="form-control">
                                <!--placeholder-->
                            <option value="0" selected >--- إختار الحالة---</option>
                                <option value="1" {{ $invoice->status == 1 ? 'selected' : '' }} >غير مدفوع</option>
                                <option value="2" {{ $invoice->status == 2 ? 'selected' : '' }} >مدفوع</option>
                                <option value="3" {{ $invoice->status == 3 ? 'selected' : '' }} >مدفوع جزئيا</option>
                                <option value="4" {{ $invoice->status == 4 ? 'selected' : '' }} >مرتجع </option>
                                <option value="5" {{ $invoice->status == 5 ? 'selected' : '' }} >مرتجع جزئيا</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center my-3">
                        <button type="submit" class="btn btn-secondary">تعديل</button>
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



   {{--add product to invoice --}}
   <script>
        $(document).ready(function() {
            $('select[name="product_id"]').on('change', function() {
                var productId = $(this).val();
                var productName = $('select[name="product_id"] option:selected').text();
                console.log(productId);

                if (productId) {
                        $('.products').append('<tr><td><input type="checkbox" class="checkbox" name="product_ids[]" value="' + productId + '"></td><td><input type="text" class="form-control" readonly value="' + productName + '"></td><td><input type="number"  disabled class="form-control qty" name="qty[]" min="0" step="any" palceholder="الكمية"></td>><td><input class="form-control price" readonly type="number" step="any" name="sale_price[]"></td><td><input type="number" step="any" class="form-control product_total" value="0" readonly ></td><td><select name="unit[]" class="form-control"><option vlaue="0">إختار الوحدة</option><option vlaue="متر">متر</option><option value="كجم">كجم</option></select></td></tr>');
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>


    {{-- calculate total price  --}}
    <script>
        var totalPrice = 0 ;
        var disccount = 0;
        var net = 0;

        //loop through all checkboxes and select checked only
        $('.checkbox').each(function(index, checkbox) {
            if ($(checkbox).prop('checked')) {
                const price = parseFloat($(checkbox).closest('tr').find('.product_total').val());
                totalPrice += price;
                $('#totalBeforeDiscount').val(totalPrice.toFixed(2));




                //if user change qty or price for peviously selected checkbox

                var qtyInput = $(this).closest('tr').find('.qty');
                var priceInput = $(this).closest('tr').find('.price');
                var productTotal = $(this).closest('tr').find('.product_total');
                var total = $('#totalBeforeDiscount').val();
                qtyInput.add(priceInput).on('input', function() {
                        productTotal.val(parseFloat(qtyInput.val() * priceInput.val())).toFixed(2);
                        console.log(productTotal);

                        // Update grand total
                        var grandTotal = 0;
                        $('.product_total').each(function() {

                            grandTotal += parseFloat($(this).val());
                            console.log(grandTotal);
                        });
                        $('#totalBeforeDiscount').val(grandTotal.toFixed(2));


                        //change price after discount

                        discount = parseFloat($('#discount').val(),2).toFixed(2);
                        total = parseFloat($('#totalBeforeDiscount').val()).toFixed(2);
                        net = total - discount;
                        $('#totalAfterDiscount').val(parseFloat(net)).toFixed(2);
                })

            }
        });




        //if user check new checkbox
        $(document).on("change", ".checkbox", function(){
             $(this).parent().next().next().children().prop('disabled', false);
             $(this).parent().next().next().next().children().prop('readonly', false);

            var productId = $(this).parent().next().children().val();
            if ($(this).is(':checked')) {
                    // Checkbox is checked, do something
                    var value = $(this).val();
                    //console.log('Checkbox ' + value + ' is checked');

                    var qtyInput = $(this).closest('tr').find('.qty');
                    var priceInput = $(this).closest('tr').find('.price');
                    var productTotal = $(this).closest('tr').find('.product_total');
                    var total = $('#totalBeforeDiscount').val();
                    qtyInput.add(priceInput).on('input', function() {
                        //console.log('Quantity changed to: ' + qtyInput.val());
                        //console.log('Price changed to: ' + priceInput.val());
                        productTotal.val(parseFloat(qtyInput.val() * priceInput.val()).toFixed(2));
                        console.log(productTotal.val());
                        // Update grand total
                        var grandTotal = 0;
                        $('.product_total').each(function() {

                            grandTotal += parseFloat($(this).val());
                            console.log(grandTotal);
                        });
                       $('#totalBeforeDiscount').val(grandTotal.toFixed(2));


                        //change price after discount

                        discount = parseFloat($('#discount').val()).toFixed(2);
                        total = parseFloat($('#totalBeforeDiscount').val()).toFixed(2);
                        net = total - discount;
                        $('#totalAfterDiscount').val(parseFloat(net).toFixed(2));



                        $(document).on('input', '#discount', function(){
                            discount = parseFloat($('#discount').val(),2);
                            total = parseFloat($('#totalBeforeDiscount').val(),2);

                            net = total - discount;
                            console.log(discount ,total,net)


                            $('#totalAfterDiscount').val(parseFloat(net,2));

                        });

                    });




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

