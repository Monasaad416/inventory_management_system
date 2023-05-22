@extends('layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"> المعاملات المالية للمساهم </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/المالية</span>
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
									<h4 class="card-title mg-b-0">قائمة المعاملات</h4>

                                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("shareholders_accounts.create")}}">إضافة معاملة</a></button>

								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
                                                <th>المساهم</th>
                                                <th>المؤسس</th>
                                                <th>المبلغ</th>
                                                <th>النوع </th>
                                                <th>ملاحظات </th>
                                                <th>تعديل</th>
                                                <th>حذف</th>
											</tr>
										</thead>
										<tbody>
                                         
                                            @foreach ($accounts as $account )
                                              
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $account->shareholder->name}}</td>
                                                    <td>{{ $account->user->name}}</td>
                                                    <td>{{ $account->amount}}</td>
                                                    <td>{{ $account->type == 'capital' ? 'راس مال' : 'ربح' }}</td>
                                                    <td>{{ $account->notes }}</td>

                                                    <td>
                                                        <a href="{{route('shareholders_accounts.edit',$account->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل بيانات المصروف"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_account{{ $account->id }}" title="حذف المصروف"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('shareholders_accounts.destroy',$account)}}" method="POST">
                                                            <div class="modal fade" id="delete_account{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المصروف من قائمة المصروفات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف المصروف  {{$account->details}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$account->id}}" name="account_id">
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
                            {!! $accounts->links() !!}
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
