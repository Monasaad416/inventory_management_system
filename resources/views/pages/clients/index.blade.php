@extends('layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة العملاء</span>
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
									<h4 class="card-title mg-b-0">قائمة العملاء</h4>

                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("clients.create")}}">إضافة عميل</a></button>

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
												<th>العنوان</th>
                                                <th>البريد الإلكتروني</th>
                                                <th>ملاحظات</th>
                                                <th>تعديل</th>
                                                <th>حذف</th>
                                                <th>كشف حساب</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($clients as $client )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $client->name }}</td>
                                                    <td>{{ $client->phone}}</td>
                                                    <td>{{ $client->address}}</td>
                                                    <td>
                                                        @if($client->email  )
                                                            {{ $client->email }}
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($client->notes  )
                                                            {{ $client->notes }}
                                                        @else
                                                            <p>لا يوجد</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('clients.edit',$client->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث بيانات القسم"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_client{{ $client->id }}" title="حذف القسم"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('clients.destroy',$client)}}" method="POST">
                                                            <div class="modal fade" id="delete_client{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف العميل من قائمة العملاء</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف العميل  {{$client->name}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$client->id}}" name="id">
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


                                                <td>
                                                    <a href="{{route('clients.balance-sheet',['id' => $client->id])}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="كشف حساب"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
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
                            {!! $clients->links() !!}
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
