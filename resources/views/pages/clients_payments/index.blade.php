@extends('layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/المصروفات</span>
						</div>
					</div>
		
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المصروفات</h4>

                                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("suppliers_expenses.create")}}">إضافة مصروف</a></button>

								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الوصف </th>
                                                <th>المبلغ</th>
                                                <th>المورد</th>
                                                <th>تعديل</th>
                                                <th>حذف</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($suppliersExpenses as $suppliers_expense )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $suppliers_expense->details }}</td>
                                                    <td>{{ $suppliers_expense->amount}}</td>
                                                     <td>{{ $suppliers_expense->supplier->name}}</td>

                                                    <td>
                                                        <a href="{{route('suppliers_expenses.edit',$suppliers_expense->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل بيانات المصروف"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_suppliers_expense{{ $suppliers_expense->id }}" title="حذف المصروف"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('suppliers_expenses.destroy',$suppliers_expense)}}" method="POST">
                                                            <div class="modal fade" id="delete_suppliers_expense{{$suppliers_expense->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المصروف من قائمة المصروفات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف المصروف  {{$suppliers_expense->details}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$suppliers_expense->id}}" name="suppliers_expense_id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
                            {!! $suppliersExpenses->links() !!}
                        </div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
