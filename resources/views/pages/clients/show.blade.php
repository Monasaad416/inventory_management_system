@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">كشف حساب العميل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العملاء</span>
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




                @include('inc.messages')
                <div class="card-body">
                    <form method="post" action="{{ route('clients.balance-sheet.search') }}" autocomplete="off">
                        @csrf
                        <h5 style="font-family: 'Cairo', sans-serif;color: #3698ac; " class="mx-2 muy-3">بحث بالفترة الزمنية</h5><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">الفواتير</label>
                                    <select class="custom-select mr-sm-2" name="status">
                                        <option value="0">كل الفواتير </option>
                                        <option value="1">غير مدفوعة</option>
                                        <option value="2">مدفوعة</option>
                                        <option value="3">مدفوعة جزئيا </option>
                                        <option value="4">مرتجع</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-body datepicker-form">
                                <div class="input-group" data-date-format="yyyy-mm-dd">
                                    <span class="input-group-addon">من تاريخ</span>
                                    <input type="date"  class="form-control range-from date-picker-default" placeholder="بداية الفترة" name="from">
                                    <span class="input-group-addon">إلي تاريخ</span>
                                    <input type="date" class="form-control range-to date-picker-default" placeholder="نهاية الفترة" type="text" name="to">
                                </div>
                            </div>

                        </div>
     
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button class="btn btn-primary float-right" type="submit">بحث</button>
                    </form>
                    <div class="table-responsive my-5">
                        <h3>البيانات الأساسية العميل</h3>
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">اسم العميل</th> </th>
                                    <th class="border-bottom-0">الهاتف</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">البريد اللإلكتروني</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{$client->address}}</td>
                                        @if($client->email)
                                        <td>{{$client->email}}</td>
                                        @else
                                        <td class="text-danger">لايوجد</td>
                                        @endif
                                    </tr>
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
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
@endsection

