
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
                <h4 class="content-title mb-0 my-auto">تعديل بيانات المساهم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المساهمين</span>
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

                             <form action="{{ route('shareholders.update',$shareholder->id) }}" method="post">
                            @csrf
                             @method('PUT')
                            <div class="row">

                                <div class="col">
                                    <label>أسم المساهم </label><span class="text-danger">*</span>
                                    <input class="form-control" name="name"  type="text" value="{{ old('name', $shareholder->name) }}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>الهاتف</label><span class="text-danger">*</span>
                                    <input class="form-control" name="phone"type="text" value="{{ old('phone', $shareholder->phone) }}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>البريد الإلكتروني  </label>
                                    <input class="form-control" name="email"type="text" value="{{ old('email', $shareholder->email) }}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                 <div class="col">
                                    <label for="inputName" class="control-label">-- المؤسس-- </label>
                                    <select name="founder_id" class="form-control" >
                                        <option value="">اختر المؤسس</option>
                                        @foreach (App\Models\User::where('roles_name','["founder"]')->get() as $founder )
                                            <option value="{{$founder->id}}" {{$shareholder->user->id = $founder->id ? 'selected' : ''}}>{{$founder->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('founder_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col my-2">
                                    <label>العنوان  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="address">{{ $shareholder->address }}</textarea>
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2">
                                    <label>ملاحظات</label>
                                    <textarea class="form-control" name="notes">{{ $shareholder->notes }}</textarea>
                                </div>
                                @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col my-2">
                                    <label>عدد الاسهم  </label><span class="text-danger">*</span>
                                    <input class="form-control" name="shares"type="text" value="{{ old('shares', $shareholder->shares) }}">
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2">
                                    <label>قيمة السهم</label>
                                    <input class="form-control" name="share_value"type="text" value="{{ old('share_value', $shareholder->share_value) }}">
                                </div>
                                @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                             <input type="hidden" name="id" value="{{ $shareholder->id }}" />

                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-primary">تعديل</button>
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
