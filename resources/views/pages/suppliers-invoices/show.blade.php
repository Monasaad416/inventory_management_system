@extends('layout.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تفاصيل الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة فواتير الموردين</span>
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

							@if(session()->has('delete_invoice'))
								<script>
									window.onload = function(){
										notif({
											message: { text: "{{ Session::get('delete_invoice') }}" },
											type : 'success'

									});
									}
								</script>
							@endif


                            @include('inc.messages')
							<div class="card-body">
								<div class="table-responsive">
                                    <h3>البيانات الأساسية للفاتورة</h3>
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>

                                                <th class="border-bottom-0">اسم المورد</th> </th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتوة</th>
												<th class="border-bottom-0">اخر موعد للدفع</th>
												{{-- <th class="border-bottom-0">المنتج</th> --}}
                                                <th class="border-bottom-0">مبلغ الخصم</th>
                                                <th class="border-bottom-0">الإجمالي    </th>
                                                <th class="border-bottom-0">حالة الفاتورة</th>
                                                <th class="border-bottom-0">ملاحظات</th>
											</tr>
										</thead>
										<tbody>

												<tr>
                                                    <td>{{$invoice->user->name}}</td>
                                                    <td>{{$invoice->supplier_invoice_number}}</td>
													{{-- <td class="color"><a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a></td> --}}
													<td>{{$invoice->supplier_invoice_date}}</td>
													<td>{{$invoice->due_date}}</td>
                                                    {{-- <td class="color"><a href="{{route('sections.show',$invoice->section->id)}}">{{$invoice->section->section_name}}</a></td> --}}
													{{-- <td>{{$invoice->products->product_name}}</td> --}}

                                                    <td>{{$invoice->discount}}</td>

													<td>{{$invoice->total}}</td>
															<td>
                                                        @if ($invoice->status == 1)
                                                            <span class="text-danger">غير مدفوع</span>
                                                        @elseif($invoice->status == 2)
                                                            <span class="text-success">مدفوع</span>
                                                        @elseif($invoice->status == 3)
                                                        <span class="text-secondary">مدفوع جزئي</span>
                                                                 @elseif($invoice->status == 4)
                                                        <span class="text-warning">مرتجع</span>
                                                                 @elseif($invoice->status == 5)
                                                        <span class="text-secondary">مرتجع جزئي</span>
                                                        @endif
                                                    </td>

                                                    @if($invoice->notes)
                                                    <td>{{$invoice->note}}</td>
                                                    @else
                                                    <td>لا يوجد</td>
                                                    @endif
												</tr>

										</tbody>
									</table>

                                    <h3>بنود الفاتورة</h3>
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>

                                                <th class="border-bottom-0">اسم المنتج</th> </th>
												<th class="border-bottom-0">الكمية</th>
												<th class="border-bottom-0">سعر الوحدة </th>
												<th class="border-bottom-0">سعر الوحدة  </th>
												<th class="border-bottom-0">أجمالي السعر  </th>
                                                <th>العمليات</th>
											</tr>
										</thead>
										<tbody>

                                            @foreach ($invoice->products as $product)

                                            {{-- @php
                                                $pivotRow = DB::table('product_supplier_invoice')->where('product_id', '=', $product->id)->first();
                                            @endphp --}}

												<tr>
                                                    <td>{{$product->product_name}}</td>
                                                    <td>{{ $product->pivot->qty }}</td>
                                                    <td>{{ $product->pivot->product_price }}</td>
                                                    <td>{{ $product->pivot->product_price }}</td>
                                                    <td>{{ $product->pivot->total }}</td>
                                                    <td>
                                                                            <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                            العمليات
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                            <a class="dropdown-item" href="{{route('suppliers-invoice-item.edit', $product->pivot->id )}}" title="{{ $product->pivot->id }}" >
                                                                <i class="fa fa-edit text-info mx-1" ></i>تعديل كمية البند
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('suppliers-invoices-item.return.view',['item_id'=> $product->pivot->id])}}">
                                                                <i class="fa fa-trash text-secondary mx-1"></i>تحويل كل الكمية إلي مرتجع
                                                            </a>

                                                            <a class="dropdown-item" href="{{route('suppliers-invoices-item.return.part.view',['item_id'=> $product->pivot->id])}}">
                                                                <i class="fa fa-trash text-danger mx-1"></i>تحويل جزء من الكمية إلي مرتجع
                                                            </a>



{{--
                                                        <button type="button" class="btn btn-danger btn-sm" >
                                                              <a class="dropdown-item"  href="#" class="modal-effect text-danger btn-sm" data-toggle="modal"  data-effect="effect-flip-vertical" data-target="#return{{$product->pivot->id}}">
                                                                <i class="fa fa-eye text-secondary mx-1"></i>تحويل إلي مرتجع
                                                            </a>
                                                        </button>
                                                    </td>
                                                        <!-- Delete Modal -->
                                                        <form action="{{route('suppliers-invoices-item.return',$product->pivot )}}" method="POST">
                                                            <div class="modal fade" id="return{{ $product->pivot->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h6 class="modal-title">تحويل البند إلي مرتجع</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من إعادة البند وخصمة من رصيد المخزن   {{$product->product_name}}</p>

                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                            <input type="text" value="{{$product->pivot->id}}" name="item_id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                          </div>
                                                    </td> --}}
												</tr>



                                                    </td>

                                                </tr>



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
