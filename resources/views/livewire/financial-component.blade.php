@can("supplier")
    <div class="row">
        <!--div-->
        @include('inc.messages')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title my-3">  المراجعة المالية للمورد</h5>
                        {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
                    </div>

                    <div class="row my-5">

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
                        <table id="example1" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">البند  </th>
                                            <th class="border-bottom-0"> المبلغ (جنية) </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <th class="border-bottom-0">إجمالي فواتير الشراء </th>
                                            <th class="border-bottom-0">{{ number_format($purchases,2)}} </th>
                                        </tr>
                                        @php
                                            $outcomes = App\Models\Outcome::where( function($query) {
                                            if(!empty($this->from_date) && !empty($this->to_date)  ){
                                                $query->whereBetween('created_at', [$this->from_date,$this->to_date]);

                                            }
                                        })->where('outcomable_type','App\Models\User')->where('outcomable_id',auth()->user()->id)->sum('amount');

                                        @endphp
                                        <tr>
                                            <th class="border-bottom-0">مصروفات  </th>
                                            <th class="border-bottom-0">{{ number_format($outcomes,2) }} </th>
                                        </tr>


                                        <tr>
                                            <th class="border-bottom-0">دفعات  للمورد </th>
                                            <th class="border-bottom-0">{{ number_format($part_paid_purchases,2) }} </th>
                                        </tr>
                                        @php
                                        $rest = $purchases - $outcomes - $part_paid_purchases;
                                        @endphp


                                        <tr>
                                            <th class="border-bottom-0">المبلغ المتبقي للمورد  </th>
                                            <th class="border-bottom-0">{{ number_format($rest,2) }} </th>
                                        </tr>

                                        <tr>
                                            <th class="border-bottom-0">المرتجع</th>
                                            <th class="border-bottom-0">{{ number_format($returnedItems,2) }} </th>
                                        </tr>



                                    </tbody>
                                </table>
                    </div>


                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center align-items-baseline">
            {!! $outcomes->links() !!}
        </div> --}}
        <!--/div-->
    </div>
@endauth
@can("client")
        <div class="row">
        <!--div-->
        @include('inc.messages')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title my-3">  المراجعة المالية للعميل</h5>
                        {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
                    </div>

                    <div class="row my-5">

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
                        <table id="example1" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">البند  </th>
                                            <th class="border-bottom-0"> المبلغ (جنية) </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <th class="border-bottom-0">إجمالي فواتير البيع </th>
                                            <th class="border-bottom-0">{{ number_format($sales,2)}} </th>
                                        </tr>



                                        <tr>
                                            <th class="border-bottom-0">دفعات  للعميل </th>
                                            <th class="border-bottom-0">{{ number_format($clientsPayments,2) }} </th>
                                        </tr>


                                        @php
                                            $rest = $sales - $clientsPayments;
                                        @endphp
                                        <tr>
                                            <th class="border-bottom-0">المبلغ المتبقي للعميل  </th>
                                            <th class="border-bottom-0">{{ number_format($rest,2) }} </th>
                                        </tr>

                                        <tr>
                                            <th class="border-bottom-0">المرتجع</th>
                                            <th class="border-bottom-0">{{ number_format($returnedItems,2) }} </th>
                                        </tr>




                                    </tbody>
                                </table>
                    </div>


                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center align-items-baseline">
            {!! $outcomes->links() !!}
        </div> --}}
        <!--/div-->
    </div>
@endcan
@can('admin')
  <div class="row">
    <!--div-->
    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3"> المراجعة المالية</h5>
                    {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
                </div>

                <div class="row my-5">

                {{-- <div class="col">
                    <label for="">بحث بالمورد</label>
                    <select wire:model="supplier_id" class="form-control" id="supplier_id" value="{{ old('supplier_id')}}" >
                        <option value="">-- إختار المورد--</option>
                        @foreach(App\Models\Supplier::all() as $supplier)
                            <option value ="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div> --}}

                @if(auth()->user()->roles_name == ["admin"])
                <div class="col">
                    <label for="">بحث بالمؤسس</label>
                    <select wire:model="user_id" class="form-control" >
                        <option value="">-- إختار المؤسس--</option>
                        @foreach(App\Models\User::where('roles_name','["founder"]')->get() as $user)
                            <option value ="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

               <div class="col">
                    <label for="">بحث بالعميل</label>
                    <select wire:model="client_id" class="form-control" id="client_id" value="{{ old('client_id') }}" >
                        <option value="">-- إختار العميل--</option>
                        @foreach(App\Models\User::where('roles_name','["client"]')->get() as $client)
                            <option value ="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col">
                    <label for="">بحث  بمصروفات المخزن </label>
                    <select wire:model="store" class="form-control" id="store" value="{{ old('store') }}" >
                        <option value="">-- إختار --</option>
                        <option value ="1">مصروفات المخزن</option>
                    </select>
                </div>
                --}}

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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="border-bottom-0">إجمالي فواتير البيع </th>
                                        <th class="border-bottom-0">{{ number_format($sales,2) }} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">إجمالي فواتير الشراء </th>
                                        <th class="border-bottom-0">{{ number_format($purchases,2)}} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">مصروفات  </th>
                                        <th class="border-bottom-0">{{ number_format($outcomes,2) }} </th>
                                    </tr>



                                     <tr>
                                        <th class="border-bottom-0">دفعات من العملاء </th>
                                        <th class="border-bottom-0">{{ number_format($clientsPayments,2) }} </th>
                                    </tr>


                                     <tr>
                                        <th class="border-bottom-0">دفعات  للموردين </th>
                                        <th class="border-bottom-0">{{ number_format($part_paid_purchases,2) }} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهمين </th>
                                        <th class="border-bottom-0">{{ number_format($sharesValue,2) }} </th>
                                    </tr>
                                    <tr>
                                        <th> ربح المؤسسين</th>
                                        {{-- @php
                                            $total = $clientsPayments -$outcomes - $part_paid_purchases - $shareProfit;
                                        @endphp --}}
                                        <th>{{ number_format($foundersValue,2)}} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهمين </th>
                                        <th class="border-bottom-0">{{ number_format($shareholdersPayments,2)}} </th>
                                    </tr>
                                    <tr>
                                        <th> دفعات المؤسسين</th>
                                        <th class="border-bottom-0">{{ number_format($foundersPayments,2)}} </th>
                                    </tr>



                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center align-items-baseline">
        {!! $outcomes->links() !!}
    </div> --}}
    <!--/div-->
</div>
@endcan


@can('founder')
  <div class="row">
    <!--div-->
    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3">  المراجعة المالية للمؤسس {{ auth()->user()->id }}</h5>
                    {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
                </div>

                <div class="row my-5">

                {{-- <div class="col">
                    <label for="">بحث بالمورد</label>
                    <select wire:model="supplier_id" class="form-control" id="supplier_id" value="{{ old('supplier_id')}}" >
                        <option value="">-- إختار المورد--</option>
                        @foreach(App\Models\Supplier::all() as $supplier)
                            <option value ="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div> --}}



               <div class="col">
                    <label for="">بحث بالمساهم</label>
                    <select wire:model="shareholder_id" class="form-control" id="shareholder_id" value="{{ old('shareholder_id') }}" >
                        <option value="">-- إختار المساهم--</option>
                        @foreach(App\Models\User::where('roles_name','["shareholder"]')->get() as $shareholder)
                            <option value ="{{$shareholder->id}}">{{$shareholder->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col">
                    <label for="">بحث  بمصروفات المخزن </label>
                    <select wire:model="store" class="form-control" id="store" value="{{ old('store') }}" >
                        <option value="">-- إختار --</option>
                        <option value ="1">مصروفات المخزن</option>
                    </select>
                </div>
                --}}

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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهمين </th>
                                        <th class="border-bottom-0">{{ number_format($sharesValue,2) }} </th>
                                    </tr>
                                    <tr>
                                        <th> ربح المؤسس</th>
                                        {{-- @php
                                            $total = $clientsPayments -$outcomes - $part_paid_purchases - $shareProfit;
                                        @endphp --}}
                                        <th>{{ number_format($foundersValue,2)}} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهمين </th>
                                        <th class="border-bottom-0">{{ number_format($shareholdersPayments,2)}} </th>
                                    </tr>
                                    <tr>
                                        <th> دفعات المؤسسين</th>
                                        <th class="border-bottom-0">{{ number_format($foundersPayments,2)}} </th>
                                    </tr>


                                    <tr>
                                        <th class="border-bottom-0">المتبقي من دفعات المساهمين </th>
                                        <th class="border-bottom-0">{{ number_format($shareholdersRest,2)}} </th>
                                    </tr>
                                    <tr>
                                        <th> المتبقي من دفعات المؤسسين</th>
                                        <th class="border-bottom-0">{{ number_format($foundersRest,2)}} </th>
                                    </tr>
                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center align-items-baseline">
        {!! $outcomes->links() !!}
    </div> --}}
    <!--/div-->
</div>
@endcan



@can('shareholder')
  <div class="row">
    <!--div-->
    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3">  المراجعة المالية للمساهم {{ auth()->user()->id }}</h5>
                    {{-- <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button> --}}
                </div>

                <div class="row my-5">

                {{-- <div class="col">
                    <label for="">بحث بالمورد</label>
                    <select wire:model="supplier_id" class="form-control" id="supplier_id" value="{{ old('supplier_id')}}" >
                        <option value="">-- إختار المورد--</option>
                        @foreach(App\Models\Supplier::all() as $supplier)
                            <option value ="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div> --}}



                {{-- <div class="col">
                    <label for="">بحث  بمصروفات المخزن </label>
                    <select wire:model="store" class="form-control" id="store" value="{{ old('store') }}" >
                        <option value="">-- إختار --</option>
                        <option value ="1">مصروفات المخزن</option>
                    </select>
                </div>
                --}}

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
                      <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">البند  </th>
                                        <th class="border-bottom-0"> المبلغ (جنية) </th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <th class="border-bottom-0">ربح  المساهم </th>
                                        <th class="border-bottom-0">{{ number_format($sharesValue,2) }} </th>
                                    </tr>


                                    <tr>
                                        <th class="border-bottom-0">دفعات  المساهم </th>
                                        <th class="border-bottom-0">{{ number_format($shareholderPayments,2)}} </th>
                                    </tr>

                                    <tr>
                                        <th class="border-bottom-0">المتبقي من دفعات المساهم </th>
                                        <th class="border-bottom-0">{{ number_format($shareholderRest,2)}} </th>
                                    </tr>
                                </tbody>
                            </table>
                </div>


            </div>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center align-items-baseline">
        {!! $outcomes->links() !!}
    </div> --}}
    <!--/div-->
</div>
@endcan
