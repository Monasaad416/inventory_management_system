
@extends('layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> حاسبة الكميات</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('inc.errors')

                        <div class="row">

                            <div class="col">
                                <label>الكمية بالبوصة </label>
                                <input class="form-control" id="inch-amount" placeholder="أدخل الكمية بالبوصة" type="number" onchange="myFunction()" >
                            </div>

                            <div class="col">
                                <label> سمك الماسورة بالمللي </label>
                                <input class="form-control" id="size-mm" placeholder="أدخل سمك الماسورة بالمللي" type="number" onchange="myFunction()">
                            </div>



                         <div class="col">
                                <label>الناتج</label>
                                <input class="form-control " id="result"  type="number"  readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')


    <script>
        function myFunction() {
            var inchAmount = parseFloat(document.getElementById("inch-amount").value);
            var sizeMM = parseFloat(document.getElementById("size-mm").value);


                var result = inchAmount * sizeMM * 0.24 ;

                document.getElementById("result").value = result;

        }
    </script>
@endsection

