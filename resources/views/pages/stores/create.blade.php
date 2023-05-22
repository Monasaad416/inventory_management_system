
@extends('layout.master')
@section('css')
    @push('css')

    @endpush
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">إضافة مصروف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مصروفات المخزن</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>
                        {{-- @include('inc.errors') --}}

                        <form action="{{ route('stores.store') }}" method="post">
                            @csrf
                            <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">تفاصيل المصروف</label>
                                        <input type="text" name="details" class="form-control" >
                                    </div>
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                <div class="col">
                                        <label for="inputName" class="control-label">المبلغ</label>
                                        <input type="number"  step="any" name="amount" min="0" class="form-control" >
                                    </div>
                                    @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>


                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
