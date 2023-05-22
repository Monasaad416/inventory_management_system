  <div class="row">
    <!--div-->
    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title my-3">كشف حساب كل العملاء </h5>
                    <button class="btn btn-primary"><a class="x-small text-white" wire:click="export" >تصدير إلي إكسيل</a></button>
                </div>

                <div class="row my-5">

                <div class="col">
                    <label for="">بحث بالعميل</label>
                    <select wire:model="client_id" class="form-control" id="client_id" value="{{ old('client_id') }}" >
                        <option value="">-- إختار العميل--</option>
                        @foreach(App\Models\Client::all() as $client)
                            <option value ="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
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
                                <th>إسم العميل</th>
                                <th>رقم الفاتورة </th>
                                <th>إجمالي المبلغ</th>
                                <th>ماتم سدادة</th>
                                    <th>المتبقي </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($clientInvoices as $invoice )
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $invoice->client->name }}</td>
                                    <td>{{ $invoice->client_invoice_number }}</td>
                                    <td>{{ $invoice->total}}</td>
                                    <td>{{ $invoice->part_paid}}</td>
                                    <td>{{ $invoice->total - $invoice->part_paid}}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-baseline">
        {!! $clientInvoices->links() !!}
    </div>
    <!--/div-->
</div>
