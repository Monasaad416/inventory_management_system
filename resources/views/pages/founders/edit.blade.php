
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
                <h4 class="content-title mb-0 my-auto">تعديل بيانات مساهم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموردين</span>
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
                            <form action="{{ route('founders.update',$founder->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col">
                                        <label>أسم المؤسس </label><span class="text-danger">*</span>
                                        <input class="form-control" name="name"  type="text" value="{{ old('name', $founder->name) }}">
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col">
                                        <label>الهاتف</label><span class="text-danger">*</span>
                                        <input class="form-control" name="phone"type="text" value="{{ old('phone', $founder->phone) }}">
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col">
                                        <label>البريد الإلكتروني  </label>
                                        <input class="form-control" name="email"type="text" value="{{ old('email', $founder->email) }}">
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="col my-2">
                                            <label>العنوان  </label><span class="text-danger">*</span>
                                            <textarea class="form-control" name="address">{{ $founder->address }}</textarea>
                                        </div>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="col my-2">
                                            <label>ملاحظات</label>
                                            <textarea class="form-control" name="notes">{{ $founder->notes }}</textarea>
                                        </div>
                                        @error('notes')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{ $founder->id }}" />

                                <div class="d-flex justify-content-center my-3">
                                    <button type="submit" class="btn btn-primary">تعديل</button>
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
