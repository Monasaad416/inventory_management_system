@extends('layout.master')
@section('css')
@endsection


@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
				<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا {{ Auth::user()->name}}</h2>
				<p class="mg-b-0">لوحة تحكم العميل.</p>
			</div>
		</div>

	</div>
	<!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
    <!-- table opened -->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <!-- balance sheet button-->
                <div class=" d-inline-flex justify-content-around mt-5">
                    <div><button class="btn btn-secondary">
                         <a href="{{route('clients.balance-sheet',['id' => $client->id])}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب">كشف الحساب</a>
                    </button></div>
                    {{-- <div><button class="custom_button"><a class="custom_link" href="{{route('export_excel')}}"> Export To Excel </a></button></div> --}}
                </div>
                <!-- balance sheet button-->

                @include('inc.messages')
                <div class="card-body">
                    <div class="table-responsive">
                        @if($clientInvoices->count() > 0)
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ الفاتوة</th>
                                    <th class="border-bottom-0">اخر موعد للدفع</th>
    
                                    <th class="border-bottom-0">الإجمالي </th>
                                    <th class="border-bottom-0">المدفوع </th>
                                    <th class="border-bottom-0">المتبقي </th>
                                    <th class="border-bottom-0">حالة الفاتورة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">طباعة الفاتورة</th>
                                    {{-- <th class="border-bottom-0">تحميل الفاتورة</th> --}}

                                </tr>
                            </thead>
                            <tbody>

                                    @foreach($clientInvoices as $invoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$invoice->client_invoice_number}}</td>
                                            <td>{{$invoice->client_invoice_date}}</td>
                                            <td>{{$invoice->due_date}}</td>
    
                                            <td>{{$invoice->total}}</td>
                                            <td>{{$invoice->part_paid}}</td>
                                             <td>{{$invoice->total - $invoice->part_paid}}</td>
                                            <td>
                                                @if ($invoice->status == 1)
                                                    <span class="text-danger">غير مدفوع</span>
                                                @elseif($invoice->status == 2)
                                                    <span class="text-success">مدفوع</span>
                                                @elseif($invoice->status == 3)
                                                    <span class="text-secondary">مدفوع جزئيا</span>
                                                @elseif($invoice->status == 4)
                                                <span class="text-secondary">مرتجع</span>
                                                @elseif($invoice->status == 5)
                                                <span class="text-secondary">مرتج جزئي</span>
                                                @endif
                                            </td>
                                            </td>
                                            @if($invoice->notes)
                                            <td>{{$invoice->note}}</td>
                                            @else
                                            <td>لا يوجد</td>
                                            @endif

                                            <td><a class="dropdown-item" href="{{route('print-client-invoice',['invoice_id'=>$invoice->id])}}"><i class="fa fa-print mx-1 text-purple" aria-hidden="true"></i></a></td>
                                        </tr>


                                    @endforeach
                            </tbody>
                        </table>

                        @else
                            <p class="text-danger">لا يوجد بيانات للعرض</p>
                        @endif
                    </div>
                    {!! $clientInvoices->links() !!}
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
