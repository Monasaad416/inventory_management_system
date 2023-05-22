
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
                <h4 class="content-title mb-0 my-auto">إضافة منتج</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
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

                        <form action="{{ route('products.store') }}" method="post">
                            @csrf
                            <div class="row">
                                    <div class="col my-3">
                                        <label for="inputName" class="control-label">إسم المنتج</label>
                                        <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}" >
                                    </div>
                                    @error('product_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col my-3">
                                        <label for="inputName" class="control-label">كود المنتج</label>
                                        <input type="text" name="product_code" class="form-control" value="{{old('product_code')}}" >
                                    </div>
                                    @error('product_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                <div class="col my-3">
                                        <label for="inputName" class="control-label">رصيد المخزن </label>
                                        <input type="number" name="store_amount" min="0" class="form-control" value="{{old('store_amount')}}" step="any">
                                    </div>
                                    @error('store_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">


                            <div class="col my-6">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section_id" class="form-control ">
                                    <option value="0"> --إختار القسم--</option>
                                     @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}> {{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror



                            <div class="col my-6">
                                    <label for="inputName" class="control-label">الوحدة</label>
                                    <select name="unit" class="form-control" >
                                        <option value="">إختار وحدة القياس</option>
                                        <option value="1">متر</option>
                                        <option value="2">كجم</option>

                                    </select>
                                </div>
                                @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col my-2">
                                    <label>وصف المنتج  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col my-2">
                                    <label>سعر الشراء  </label><span class="text-danger">*</span>
                                    <input class="form-control" name="purchase_price" type="number" step="any" value="{{old('purchase_price')}}">
                                </div>
                                @error('purchase_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2">
                                    <label>سعر البيع  </label><span class="text-danger">*</span>
                                    <input class="form-control" name="sale_price" type="number" step="any" value="{{old('sale_price')}}">
                                </div>
                                @error('sale_price')
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
{{-- @section('js')
    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var sectionId = $(this).val();
               // console.log(sectionId);
                if (sectionId) {
                    console.log(sectionId);
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to('/getSuppliersBySection') }}/" + sectionId ,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="supplier_id"]').empty();
                            $('select[name="supplier_id"]').append('<option value=""> إختار المورد ---</option>');
                            $.each(data, function(key, value) {

                            $('select[name="supplier_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection --}}
