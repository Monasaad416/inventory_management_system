
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
                <h4 class="content-title mb-0 my-auto">تعديل بيانات عميل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الموردين</span>
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

                        <form action="{{ route('clients.update',$client->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col">
                                    <label>أسم العميل </label><span class="text-danger">*</span>
                                    <input class="form-control" name="name"  type="text" value="{{ old('name', $client->name) }}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>الهاتف</label><span class="text-danger">*</span>
                                    <input class="form-control" name="phone"type="text" value="{{ old('phone', $client->phone) }}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>البريد الإلكتروني  </label>
                                    <input class="form-control" name="email" type="email" value="{{ old('email', $client->email) }}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col my-2">
                                    <label>العنوان  </label><span class="text-danger">*</span>
                                    <textarea class="form-control" name="address">{{ $client->address }}"</textarea>
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2">
                                    <label>ملاحظات</label>
                                    <textarea class="form-control" name="notes">{{ $client->notes }}</textarea>
                                </div>
                                @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            {{-- <label for="inputName" class="control-label">القسم</label>
                                <select name="section_id" class="form-control ">
                                    <option value="0">--إختار القسم --</option>
                                     @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ $section->id == $client->section->id ? 'selected' : ''}}> {{ $section->section_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}


                            <input type="hidden" name="id" value="{{ $client->id }}" />



                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-secondary">تعديل</button>
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
