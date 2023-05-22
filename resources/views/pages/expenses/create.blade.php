
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
                <h4 class="content-title mb-0 my-auto">إضافة مصروف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المصروفات</span>
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

                        <form action="{{ route('expenses.store') }}" method="post">
                            @csrf
                            <div class="row">
                                     <div class="col">
                                <label for="inputName" class="control-label">المورد</label>
                                <select name="suppliers_id" class="form-control ">
                                    <option value="0"> --أختار المورد --</option>
                                     @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}> {{ $supplier->name }}</option>
                                     @endforeach

                                </select>
                            </div>


                                @error('suppliers_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                        <label for="inputName" class="control-label">المبلغ  </label>
                                        <input type="number" name="payment_amount" min="0" class="form-control" step="any" value="{{ old('payment_amount')}}">
                                    </div>
                                    @error('payment_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="row">
                                <div class="col my-2">
                                    <label>وصف المصروف  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="note"> {{ old('notes')}}</textarea>
                                </div>
                                @error('note')
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
