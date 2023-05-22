
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
                <h4 class="content-title mb-0 my-auto">إضافة مورد</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموردين</span>
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

                        <form action="{{ route('suppliers.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col">
                                    <label>أسم المورد </label><span class="text-danger">*</span>
                                    <input class="form-control" name="name" type="text" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>الهاتف</label><span class="text-danger">*</span>
                                    <input class="form-control" name="phone"type="text" value="{{old('phone')}}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>البريد الإلكتروني  </label>
                                    <input class="form-control" name="email" type="email" value="{{old('email')}}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col my-2">
                                    <label>العنوان  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="address">{{old('address')}}</textarea>
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2">
                                    <label>ملاحظات</label>
                                    <textarea class="form-control" name="notes">{{old('notes')}}</textarea>
                                </div>
                                @error('notes')
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
@section('js')

@endsection
