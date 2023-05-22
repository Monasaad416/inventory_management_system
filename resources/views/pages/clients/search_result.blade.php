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
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">

        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
    <!-- table opened -->
        <div class="col-xl-12">
            <div class="card mg-b-20">




                @include('inc.messages')
                 <div class=" main-content-body-invoice my-5 mx-3" id="print">
                <div class="d-flex">
                    @if($from && $to)
                    <h5 class="content-title mb-0 my-auto">كشف حساب العميل عن الفترة من <span class="text-danger">{{$from }}</span> الي  <span class="text-danger">  {{$to }}</span></h5><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
                    @else
                      <h5 class="content-title mb-0 my-auto">كشف حساب العميل  - </span></h5><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
                    @endif
                    <br>
                    @if($status = 0)
                        <h5 class="content-title mb-0 my-auto">كل الفواتير</h5>
                    @elseif($status = 1)
                        <h5 class="content-title mb-0 my-auto">  الفواتير الغير مدفوعة</h5>
                    @elseif($status =2)
                        <h5 class="content-title mb-0 my-auto">الفواتير المدفوعة  </h5>
                    @elseif($status =3)
                        <h5 class="content-title mb-0 my-auto">الفواتير المدفوعة جزئيا </h5>
                    @elseif($status = 4)
                    <h5 class="content-title mb-0 my-auto">المرتجع </h5>
                    @endif
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($invoices->count() > 0)
                            <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>

                                        <th class="border-bottom-0">رقم الفاتورة </th>
                                        <th class="border-bottom-0">مبلغ الفاتورة   </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->client_invoice_number}}</td>
                                            <td>{{ $invoice->total}}</td>

                                            <td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th class="border-bottom-0" style=" background-color:#f5f1f0">إجمالي قيمة الفواتير   </th>
                                        <th class="border-bottom-0" style=" background-color:#f5f1f0">{{ $invoices->sum('total') }}جنيه</th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0 "style=" background-color:#f5f1f0">إجمالي ماتم سداده من العميل    </th>
                                        <th class="border-bottom-0" style=" background-color:#f5f1f0">{{ $invoices->sum('part_paid') }}جنيه</th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0 "style=" background-color:#f5f1f0">المبلغ المتبقي  من العميل    </th>
                                        <th class="border-bottom-0" style=" background-color:#f5f1f0">{{$invoices->sum('total') -  $invoices->sum('part_paid') }}جنيه</th>
                                    </tr>

                                </tbody>
                            </table>
                            @else
                            <h5 class="text-danger"> لايوجد فواتير للعرض   </h5>

                            @endif
                            <hr>

                        </div>
                    </div>
                                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_button" onclick="printDiv()"> <i
                                class="fas fa-print ml-1"></i>Print</button>
                 </div>

            </div>
        </div>
    <!-- /table -->
    </div>
    <!-- row closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>


@section('js')



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

@endsection
