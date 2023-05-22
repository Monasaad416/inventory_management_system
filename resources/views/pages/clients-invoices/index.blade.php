@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة فواتير العملاء</span>
            </div>
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

                    <!-- add section button start-->
                <div class=" d-inline-flex justify-content-around mt-5">
                    <div><button class="btn btn-primary"><a class="custom_link text-white" href="{{route('clients-invoices.create')}}">إضافة فاتورة</a></button></div>
                    {{-- <div><button class="custom_button"><a class="custom_link" href="{{route('export_excel')}}"> Export To Excel </a></button></div> --}}
                </div>
                <!-- add section button end-->

                @include('inc.messages')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم العميل</th> </th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتوة</th>
                                    <th class="border-bottom-0">اخر موعد للدفع</th>
                                    {{-- <th class="border-bottom-0">المنتج</th> --}}
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">الأجمالي بعد الخصم</th>
                                    <th class="border-bottom-0">المدفوع</th>
                                    <th class="border-bottom-0">المتبقي</th>
                                    <th class="border-bottom-0">حالة الفاتورة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientsInvoices as $invoice)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>

                                        <td>{{$invoice->user->name}}</td>
                                        <td>{{$invoice->client_invoice_number}}</td>
                                        {{-- <td class="color"><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a></td> --}}
                                        <td>{{$invoice->client_invoice_date}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{$invoice->discount}}</td>
                                        <td>{{$invoice->total}}</td>
                                        
                                        <td>{{$invoice->part_paid}}</td>
                                        <td>{{$invoice->total - $invoice->part_paid}}</td>
                                        <td>
                                            @if ($invoice->status == 1)
                                                <span class="text-primary">غير مدفوع</span>
                                            @elseif($invoice->status == 2)
                                                <span class="text-success">مدفوع</span>
                                            @elseif($invoice->status == 3)
                                                <span class="text-secondary">مدفوع جزئيا</span>
                                            @elseif($invoice->status == 4)
                                            <span class="text-danger">مرتجع</span>
                                            @elseif($invoice->status == 5)
                                            <span class="text-warning">مرتج جزئي</span>
                                            @endif
                                        </td>
                                        </td>
                                        @if($invoice->notes)
                                        <td>{{$invoice->note}}</td>
                                        @else
                                        <td>لا يوجد</td>
                                        @endif

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                العمليات
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"  href="{{route('clients-invoices.edit',$invoice)}}">
                                                    <i class="fa fa-edit text-info mx-1"></i>تعديل الفاتورة
                                                    </a>

                                                <a class="dropdown-item"  href="{{route('clients-invoices.show',$invoice)}}">
                                                    <i class="fa fa-eye text-secondary mx-1"></i>تفاصيل الفاتورة
                                                </a>
                                                    <a class="dropdown-item" href="#" class="modal-effect text-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-effect="effect-flip-vertical"
                                                    data-target="#delete{{$invoice->id}}" title="Delete Invoice">
                                                        <i class="fa fa-trash text-danger mx-1"></i> تحويل إلي مرتجع
                                                    </a>

                                                            <a class="dropdown-item" href="#" class="modal-effect text-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-effect="effect-flip-vertical"
                                                                data-target="#partiallyPaid{{ $invoice->id }}" title="دفع جزء من الفاتورة">
                                                                    <i class="fas fa-money-bill-wave text-success mx-1"></i> دفع جزئي
                                                            </a>

                                                            <a class="dropdown-item" href="{{route('print-client-invoice',['invoice_id'=>$invoice->id])}}"><i class="fa fa-print mx-1" aria-hidden="true"></i>طباعة الفاتورة</a>

                                                </div>
                                        </td>
                                    </tr>

                                  			   <!--Reteun Invoice Modal Start-->
                                                <div class="modal" id="delete{{$invoice->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">تحويل الفاتورة إلي مرتجع  </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('clients-invoice.return',$invoice->id)}}">
                                                                                                    @csrf
                                                                                                     {{-- {{ method_field('delete') }} --}}
                                                                                                    <p class="text-danger font-weight-bold my-3">هل انت متأكد من حذف الفاتورة رقم  {{$invoice->client_invoice_number}}</p>
                                                                                                    <input class="form-control" name="invoice_id" value="{{$invoice->id}}" type="hidden">
                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق</button>
                                                                                                        <button type="submit" class="btn btn-danger pd-x-20">حذف</button>
                                                                                                    </div>
                                                                                                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Reteun Invoice  Modal End-->


                                                <!--Partially Paid Invoice Modal Start-->
                                                <div class="modal" id="partiallyPaid{{$invoice->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title"> دفع جزء من الفاتورة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="bg-gray-200 p-4">
                                                                                                <form method ="POST" action="{{route('clients-invoice.partially-paid',$invoice->id)}}">
                                                                                                    @csrf
                                                                                                     {{-- {{ method_field('delete') }} --}}
                                                                                                    <p class=" font-weight-bold my-3">ادخل المبلغ الذي تم سداده   من الفاتورة رقم  {{$invoice->client_invoice_number}}</p>
                                                                                                    <input class="form-control" name="invoice_id" value="{{$invoice->id}}" type="hidden">

                                                                                                    <input type="number" name="partially_paid"  pattern="^\d*(\.\d{0,2})?$"  step="0.01" class="form-control">
                                                                                                    <div class="modal-footer">
                                                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                                                                                                        <button type="submit" class="btn btn-primary pd-x-20">حفظ</button>
                                                                                                    </div>
                                                                                                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Partially Paid Invoice  Modal End-->


                                @endforeach
                            </tbody>
                        </table>
                    </div>

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
@endsection
