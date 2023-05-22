
@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">

                {{-- <h4 class="content-title mb-0 my-auto">تعديل كمية البند  {{ $prodroduct->product_name }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فواتير الموردين </span> --}}
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- @include('inc.errors') --}}
                    <form action="{{ route('clients-invoice-item.update' , $pivotRow->id) }}" method="post">
                        @csrf

                        <div class="row">
                            <input type="hidden" name="item_id" value="{{ $pivotRow->id}}" >

                            <div class="col">
                                <label>تعديل كمية البند </label>
                                <input class="form-control"  type="number"  step="any" name="qty" min="1"  value="{{ old('qty', $pivotRow->qty) }}">
                            </div>
                            @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">تحديث حالة الدفع للبند</label>
                                <select name="status" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" >
                                    <!--placeholder-->
                                    <option value="0" selected >--- إختار الحالة---</option>
                                    <option value="1" {{ $pivotRow->status == 1 ? 'selected' : '' }}>غير مدفوع</option>
                                    <option value="2" {{ $pivotRow->status == 2 ? 'selected' : '' }}>مدفوع</option>
                                    <option value="3" {{ $pivotRow->status == 3 ? 'selected' : '' }}>مرتجع</option>
                                </select>
                            </div>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-secondary">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


