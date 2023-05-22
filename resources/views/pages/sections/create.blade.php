
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
                <h4 class="content-title mb-0 my-auto">إضافة قسم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام</span>
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

                        <form action="{{ route('sections.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col">
                                    <label>أسم القسم </label><span class="text-danger">*</span>
                                    <input class="form-control" name="section_name"  type="text" value="{{old('section_name')}}">
                                </div>
                                @error('section_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="row">
                                <div class="col my-2">
                                    <label>الوصف  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                                </div>
                                @error('description')
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
