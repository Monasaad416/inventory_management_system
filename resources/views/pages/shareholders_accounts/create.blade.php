
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
                <h4 class="content-title mb-0 my-auto">إضافة معاملة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  المعاملات المالية للمساهم</span>
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

                        <form action="{{ route('shareholders_accounts.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                        <label for="inputName" class="control-label">تفاصيل المعاملة</label>
                                        <input type="text" name="notes" class="form-control" value="{{old('notes')}}">
                                </div>
                                @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                        <label for="inputName" class="control-label">المبلغ</label>
                                        <input type="number" name="amount" min="0" class="form-control" step="any" value="{{old('amount')}}">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">نوع المعاملة</label>
                                    <select class="form-control" name="type">
                                        <option value="0">--إختر نوع المعاملة--</option>
                                        <option value="capital" {{ old('type') == "capital" ? 'selected' : '' }}>مشاركة برأس  مال</option>
                                        <option value="profit"  {{ old('type') == "profit" ? 'selected' : '' }}>ربح</option>
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                    <label for="inputName" class="control-label">المؤسس</label>
                                    @if(auth()->user()->roles_name == ["admin"])
                                    <select class="form-control" name="user_id">
                                        <option value="0">--إختر المؤسس  --</option>
                                        @foreach(App\Models\User::where('roles_name', '["founder"]')->get() as $founder)
                                            <option value="{{ $founder->id }}" {{ old('founder_id') == $founder->id ? 'selected' : '' }}>{{ $founder->name }}</option>
                                        @endforeach
                                    </select>
                                    @elseif(auth()->user()->roles_name == ["founder"])
                                        <select class="form-control" name="user_id">
                                            <option value="0">--إختر المؤسس  --</option>
                                            <option value="{{ auth()->user()->id }}" {{ old('founder_id') == $founder->id ? 'selected' : '' }}>{{ auth()->user()->name }}</option>
                                        </select>
                                    @endif
                                </div>
                                @error('user_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                    <label for="inputName" class="control-label">المساهم</label>
                                    <select class="form-control" name="shareholder_id">
                                        <option value="0">--إختر المساهم  --</option>
                                
                                    </select>
                                </div>
                                @error('shareholder_id')
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('select[name="user_id"]').on('change', function () {
                var user_id = $(this).val();
                console.log(user_id);
                if (user_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("getShareholdersByFounder") }}/" + user_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            $('select[name="shareholder_id"]').empty();
                            $('select[name="shareholder_id"]').append('<option value="selected disabled">إختر المساهم  </option>');
                            $.each(data, function (key, value) {

                                $('select[name="shareholder_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    
@endpush




