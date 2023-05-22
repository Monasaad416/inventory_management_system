
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
                <h4 class="content-title mb-0 my-auto">إضافة معاملة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  المعاملات المالية للمؤسس</span>
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

                        <form action="{{ route('founders_accounts.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                        <label for="inputName" class="control-label">تفاصيل المعاملة</label>
                                        <input type="text" name="notes" class="form-control" value="{{ old('notes')}}">
                                </div>
                                @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                        <label for="inputName" class="control-label">المبلغ</label>
                                        <input type="number" name="amount" min="0" class="form-control" step="any" value="{{ old('amount')}}">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                {{-- <div class="col">
                                    <label for="inputName" class="control-label">نوع المعاملة</label>
                                    <select class="form-control" name="type">
                                        <option value="profit">ربح</option>
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}


                                <div class="col">
                                    <label for="inputName" class="control-label">المؤسس</label>
                                    <select class="form-control" name="user_id">
                                        <option value="0">--إختر المؤسس  --</option>
                                        @foreach(App\Models\User::where('roles_name', '["founder"]')->get() as $founder)
                                            <option value="{{ $founder->id }}" {{ old('founder_id') == $founder->id ? 'selected' : '' }}>{{ $founder->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror



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
