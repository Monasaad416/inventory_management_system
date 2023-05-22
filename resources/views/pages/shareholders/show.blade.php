@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">كشف حساب المساهم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العملاء</span>


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
                    <form method="post" action="{{ route('shareholders.balance-sheet.search') }}" autocomplete="off">
                        @csrf
                        <h5 style="font-family: 'Cairo', sans-serif;color: #3698ac; " class="mx-2 muy-3">بحث بنوع المعاملة و بالفترة الزمنية</h5><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">المعاملات</label>
                                    <select class="custom-select mr-sm-2" name="type">
                                        <option value="0">--إختر المعاملة--</option>
                                        <option value="capital">دفع رأس مال  </option>
                                        <option value="profit">ربح</option>
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
                        <input type="hidden" name="shareholder_id" value="{{ $shareholder->id }}">
                        <button class="btn btn-primary float-right" type="submit">بحث</button>
                    </form>
                    <div class="table-responsive my-5">
                        <h3>البيانات الأساسية للمساهم</h3>
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">اسم المساهم</th> </th>
                                    <th class="border-bottom-0">الهاتف</th>
                                    <th class="border-bottom-0">البريد اللإلكتروني</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{$shareholder->name}}</td>
                                        <td>{{$shareholder->phone}}</td>
                                        @if($shareholder->email)
                                        <td>{{$shareholder->email}}</td>
                                        @else
                                        <td class="text-danger">لايوجد</td>
                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive my-5">
                        <h3> كشف حساب المساهم</h3>
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <tbody>
                                    <tr>
                                        <td class="border-bottom-0"> إجمالي رأس المال المدفوع</td>
                                        <td>{{$accountCapital}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom-0"> إجمالي الأرباح  </td>
                                        <td>{{$shareholderProfit}}</td>
                                    </tr>

                                    <tr>
                                        <td class="border-bottom-0"> إجمالي ماتم إستلامه من الأرباح  </td>
                                        <td>{{$accountProfit}}</td>
                                    </tr>

                                    <tr>
                                        <td class="border-bottom-0"> المتبقي  من الأرباح</td>
                                        <td>{{$shareholderProfit - $accountProfit}}</td>
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

