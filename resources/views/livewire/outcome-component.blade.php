  <div class="row">
                <!--div-->

                @include('inc.messages')
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
   
                    
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title my-3">قائمة المصروفات</h5>
                                <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button>
                            </div>

                            <div class="row my-5">

                            <div class="col">
                                <label for="">بحث بالمورد</label>
                                <select wire:model="supplier_id" class="form-control" id="supplier_id" value="{{ old('supplier_id') }}" >
                                    <option value="">-- إختار المورد--</option>
                                    @foreach(App\Models\User::where('roles_name','["supplier"]')->get() as $supplier)
                                        <option value ="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="">بحث  بمصروفات المخزن </label>
                                <select wire:model="store" class="form-control" id="store" value="{{ old('store') }}" >
                                    <option value="">-- إختار --</option>
                                    <option value ="1">مصروفات المخزن</option>
                                </select>
                            </div>


                            <div class="col">
                                <label for="">بحث من تاريخ</label>
                                <input type="date" wire:model="from_date" class="form-control" id="from">
                            </div>
                            <div class="col">
                                <label for="">بحث إلي تاريخ</label>
                                <input type="date" wire:model="to_date" class="form-control" id="to" >
                            </div>


                        </div>

                    
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>البند</th>
                                            <th>المبلغ </th>
                                            <th>مورد/مخزن</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                      
                                        @foreach ($outcomes as $outcome )
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $outcome->details }}</td>
                                                <td>{{ $outcome->amount}}</td>
                                               
                                                    @if($outcome->outcomable_type == "App\Models\Store")
                                                    <td>مصروفات المخزن</td>
                                                    @else
                                                    <td>مصروفات المورد - {{ App\Models\User::where('roles_name','["supplier"]')->where('id',$outcome->outcomable_id)->first()->name }}</td>
                                                    @endif
                                                
         
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
                    <div class="d-flex justify-content-center align-items-baseline">
                        {!! $outcomes->links() !!}
                    </div>
                <!--/div-->
            </div>
