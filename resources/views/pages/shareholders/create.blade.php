
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
                <h4 class="content-title mb-0 my-auto">إضافة مساهم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المساهمين</span>
            </div>
        </div>
 >
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

                        <form action="{{ route('shareholders.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col">
                                    <label>أسم المساهم </label><span class="text-danger">*</span>
                                    <input class="form-control" name="name" type="text" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col">
                                    <label>الهاتف</label><span class="text-danger">*</span>
                                    <input class="form-control" name="phone" type="text" value="{{old('phone')}}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                @php
                                    if(auth()->user()->roles_name == ["admin"]){
                                        $users = App\Models\User::where('roles_name' , '["founder"]')->get();
                                    } else {
                                        $users = App\Models\User::where('roles_name' , '["founder"]')->where('id',auth()->user()->id)->get();
                                    }
                                @endphp
                               <div class="col">
                                    <label for="inputName" class="control-label"> المؤسس</label>
                                    <select name="user_id" class="form-control" >
                                        <option value="">--إختر المؤسس --</option>
                                        @foreach ( $users as $user )
                                            <option value="{{$user->id}}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('user_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                            </div>

                            <div class="row">
                               <div class="col">
                                    <label>البريد الإلكتروني  </label>
                                    <input class="form-control" name="email"type="text" value="{{old('email')}}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col">
                                    <label>كلمة المرور   </label>
                                    <input class="form-control" name="password" type="password">
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                           <div class="col">
                                    <label>تأكيد كلمة المرور   </label>
                                    <input class="form-control" name="password_confirmation" type="password">
                                </div>
                                @error('password')
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
                            <div class="row">
                                <div class="col my-2">
                                    <label>عدد الاسهم  </label><span class="text-danger">*</span>
                                    <input class="form-control" name="shares" type="number" step="any" value="{{old('shares')}}">
                                </div>
                                @error('shares')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="col my-2"><span class="text-danger">*</span>
                                    <label>قيمة السهم</label>
                                    <input class="form-control" name="share_value"type="number" step="any" value="{{old('shares_value')}}">
                                </div>
                                @error('share_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror



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
