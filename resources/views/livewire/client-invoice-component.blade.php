    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- @include('inc.errors') --}}
                    <div class="row">
                        {{-- Search with product_code --}}
                        <div class="col">
                            <form wire:submit.prevent = "insertProduct" method="post" enctype="multipart/form-data">
                             <input class="form-control" wire:model="product_code" placeholder="أدخل كود المنتج" type="text" value="{{ old('due_date')}}">
                        </div>
                    </div>
                    <form action="{{ route('clients-invoices.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" wire:model="invoice_date" placeholder="YYYY-MM-DD" type="text" value="{{ old('invoice_date')}}" >
                            </div>
                            @error('invoice_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="col">
                                <label>أخر موعد للسداد</label>
                                <input class="form-control fc-datepicker" wire:model="due_date" placeholder="YYYY-MM-DD" type="text" value="{{ old('due_date')}}">
                            </div>
                            @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select wire:model="section_id" class="form-control " >
                                    <option value="0"> --إختار القسم--</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}> {{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="col">
                                <label for="inputName" class="control-label">العميل</label>
                                <select wire:model="client_id" class="form-control SlectBox"  onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" value="{{ old('client_id')}}">


                                </select>
                            </div>
                            @error('client_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">المنتجات</label>
                                <div class="products">

                                    	<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>الإسم</th>
												<th>الوصف </th>
                                                <th>سعر الشراء</th>
                                                <th>سعر البيع</th>
                                                <th>الوحدة</th>
												<th>المورد</th>
                                                <th>القسم</th>
                                                <th>رصيد المخزن</th>
                                                <th>تعديل</th>
                                                <th>حذف</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($products as $product )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->description}}</td>
                                                    <td>{{ number_format($product->purchase_price,2) }}</td>
                                                    <td>{{ number_format($product->sale_price,2)}}</td>
                                                    <td>{{ $product->unit}}</td>
                                                    <td>{{ $product->user->name}}</td>
                                                    <td>{{ $product->section->section_name}}</td>
                                                    <td>{{ $product->store_amount}}</td>
                                                    <td>
                                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث بيانات المنتج"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_product{{ $product->id }}" title="حذف المنتج"><i class="fa fa-trash"></i></button></td>
                                                                       <!-- Delete Modal -->
                                                        <form action="{{route('products.destroy',$product)}}" method="POST">
                                                            <div class="modal fade" id="delete_product{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">حذف المنتج من قائمة المنتجات</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>هل انت متأكد من حذف المنتج  {{$product->product_name}}</p>

                                                                            @csrf
                                                                            {{method_field('delete')}}
                                                                            <input type="hidden" value="{{$product->id}}" name="id">
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
                            @error('product_ids[]')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="collection_amount" wire:model="collection_amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            @error('collection_amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <div class="col">
                                <label for="inputName" class="control-label">نسبة التحصيل</label>
                                <input type="text" class="form-control form-control-lg" id="commission_amount"
                                    wire:model="commission_amount" title="Please enter commission amount "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    onchange="myFunction()">
                            </div>
                            @error('commision_amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}


                            {{-- <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="discount" wire:model="discount"
                                    title="Please enter discount amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 onchange="myFunction()">
                            </div>
                            @error('discount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}

                        </div>

                        <div class="row">



                        </div>




                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" wire:model="note" rows="3"></textarea>
                            </div>
                            @error('note')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div><br>

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label"> مبلغ الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="discount" wire:model="discount" step="2">
                            </div>
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col">
                                <label for="inputName" class="control-label"> حالة الدفع للفاتورة</label>
                                <select wire:model="status" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" >
                                    <!--placeholder-->
                                    <option value="0" selected >--- إختار الحالة---</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }} >غير مدفوع</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }} >مدفوع</option>
                                    <option value="3" {{ old('status') == 3 ? 'selected' : '' }} >مدفوع جزئيا</option>
                                </select>
                            </div>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <p class="text-danger">* Attachment type  pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">Attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, .jpeg, .png" data-height="70" />
                        </div><br>
                        @error('file_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        --}}
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

