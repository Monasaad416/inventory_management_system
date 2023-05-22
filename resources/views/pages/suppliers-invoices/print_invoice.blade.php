@extends('layout.master')
@section('css')
    <style>
        @media print {
            #print_button {
                display: none;
            }
        }


    </style>
@endsection
@section('title')
    معاينة طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" >
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title" style="color:rgb(136, 174, 240);">
                                <img src="{{asset('assets/img/logo1.jpg')}}" width="80px">
                             </h1>
                            <div class="billed-from">

                                <h1 class="invoice-title">فاتورة مورد</h1>

                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{ $invoice->supplier_invoice_number }}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                    <span>{{ $invoice->supplier_invoice_date }}</span></p>

                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <br style="height: 3px">

                        {{-- <div class="invoice-header">
                            <h1 class="invoice-title">فاتورة مورد</h1>
                            <div class="billed-from">
                                <h3>معلومات المورد</h3>
                                <h6>الاسم: {{ $supplier->name }}</h6>
                                <p>العنوان: {{ $supplier->address }}<br>
                                    الهاتف: {{ $supplier->phone }}<br>
                                   البريدالإلكتروني: {{ $supplier->email }}</p>
                            </div><!-- billed-from --> --}}

                        </div><!-- invoice-header -->

                        <div class="container my-5">
                            <div class="row text-center">
                                <div class="col-3 text-right">
                                    <h3>معلومات المخزن</h3>
                                    <h6>الاسم:</h6>
                                    <p>العنوان: <br>
                                        الهاتف: <br>
                                    البريدالإلكتروني: </p>
                                </div>
                                <div class="col-md-1 text-right" >
                                    <div  style="height: 150px; width: 1px; background:rgb(217, 216, 216)"></div>
                                </div>
                                <div class="col-4 text-right">
                                    <h3>معلومات المورد</h3>
                                    <h6>الاسم: {{ $supplier->name }}</h6>
                                    <p>العنوان: {{ $supplier->address }}<br>
                                        الهاتف: {{ $supplier->phone }}<br>
                                        البريدالإلكتروني: {{ $supplier->email }}</p>
                                </div>
                                <div class="col-md-1 text-right" >
                                    <div  style="height: 150px; width: 1px; background:rgb(217, 216, 216)"></div>
                                </div>
                                <div class="col-3 text-right">
                                    <h3>معلومات الفاتوره</h3>
                                    <h6>رقم الفاتوره {{ $invoice->supplier_invoice_number }}</h6>
                                    <p>تاريخ الفاتوره:{{ $invoice->supplier_invoice_date }}<br>
                                        اخر موعد للسداد: {{  $invoice->due_date }}<br>
                                        الحالة: {{ $supplier->email }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>



                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">المنتج</th>
                                        <th class="">الكميه</th>
                                        <th class="">وحدة القياس</th>
                                        <th class="">سعر الوحدة(جنيه)</th>
                                        <th class="">إجمال السعر(جنيه)</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $invoiceItems = DB::table('product_supplier_invoice')->where('supplier_invoice_id', $invoice->id)->get();
                                    @endphp
                                    @foreach ( $invoiceItems as $item)
                                                 <tr>
                                        <td>1</td>

                                        <td class="">{{ App\Models\Product::where('id',$item->product_id)->first()->product_name}}</td>
                                        <td class="">{{ $item->qty }}</td>
                                        <td class="">{{ App\Models\Product::where('id',$item->product_id)->first()->unit}}</td>
                                        <td class="">{{ number_format($item->product_price, 2) }}</td>
                                        <td class="">{{ number_format($item->qty * $item->product_price, 2) }}</td>

                                    </tr>

                                    @endforeach
                                    <style>
                                        .price-custom {
                                            color: #61a2a9;
                                        }
                                    </style>

                                    <tr>
                                        <td >الإجمالي  </td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td >
                                            <h4 class="price-custom  tx-bold">{{ number_format($invoice->total, 2) }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >المبلغ المدفوع  </td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td >
                                            <h4 class="price-custom tx-bold">{{ number_format($invoice->total - $invoice->part_paid, 2) }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >مبلغ الخصم علي الفاتورة</td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td >
                                            <h4 class="price-custom tx-bold">{{ number_format($invoice->discount, 2) }}</h4>
                                        </td>
                                    </tr>

                                       <tr>
                                        <td >المبلغ المتبقي</td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td >
                                            <h4 class="price-custom tx-bold">{{ number_format($invoice->total - $invoice->part_paid, 2) }}</h4>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger btn-sm float-left mt-3 mr-2" id="print_button" onclick="printDiv()"> <i
                                class="fas fa-print ml-1"></i>Print</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->

@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
