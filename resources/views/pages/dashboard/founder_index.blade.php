@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المساهمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  قائمة المساهمين للمؤسس  {{ auth()->user()->name }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!-- table opened -->
				<!-- row opened -->
				<div class="row ">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المساهمين</h4>

                    {{-- <button class="btn btn-primary"><a class="x-small text-white" href="{{route("shareholders.create")}}">إضافة مساهم</a></button> --}}

								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
												<th>الهاتف </th>
                                                <th>عدد الاسهم </th>
                                                <th>قيمة السهم</th>
                                                <th>ملاحظات</th>
                                                <th>كشف حساب</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($shareholders as $shareholder )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $shareholder->name }}</td>
                                                    <td>{{ $shareholder->phone}}</td>

                                                    <td>
                                                        @if($shareholder->shares  )
                                                            {{ $shareholder->shares }}
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>
                                                    <td>{{ $shareholder->share_value}}</td>
                                                    <td>
                                                        @if($shareholder->notes  )
                                                            {{ $shareholder->notes }}
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>
                                          
            

                                                    <td>
                                                        <a href="{{route('shareholders.balance-sheet',['id' => $shareholder->id])}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                    </td>



                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>


							</div>
						</div>
					</div>
                       <div class="d-flex justify-content-center align-items-baseline">
                            {!! $shareholders->links() !!}
                        </div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
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
