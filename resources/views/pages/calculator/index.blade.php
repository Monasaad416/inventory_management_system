
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
                                <label>اختر بالبوصة </label>
                                <select id="inch-amount" class="form-control" onchange="myFunction()" >
                               <option value="13.7">1/4 بوصة</option>
                               <option value="17.1">3/8 بوصة</option>
                               <option value="21.3">1/2 بوصة</option>
                               <option value="26.7">3/4 بوصة</option>
                               <option value="33.4">1 بوصة</option>
                               <option value="42.2">1 1/4 بوصة</option>

                               <option value="48.3">1 1/2 بوصة</option>
                               <option value="60.3">2 بوصة</option>

                               <option value="70.00">2 1/2 بوصة</option>
                               <option value="88.9">3 بوصة</option>


                                <option value="101.60">3 1/2 بوصة</option>
                                <option value="114.3">4 بوصة</option>
                                <option value="141.3">5 بوصة</option>
                                <option value="168.3">6 بوصة</option>

                                <option value="219.1">8 بوصة</option>

                                <option value="273.1">10 بوصة</option>

                                <option value="323.9">12 بوصة</option>
                                <option value="355.6">14 بوصة</option>
                                <option value="406.4">16 بوصة</option>
                                <option value="457.2">18 بوصة</option>
                                <option value="508.0">20 بوصة</option>
                                <option value="609.6">24 بوصة</option>
                                </select>
{{--                                 <input class="form-control" id="inch-amount" placeholder="أدخل الكمية بالبوصة" type="number" onchange="myFunction()" >
 --}}                            </div>

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
                var finalResult = result.toFixed(2)

                document.getElementById("result").value = finalResult;

        }
    </script>


<script>
  $("#inch-amount").on('change', function() {
    $("#size-mm").val("");
    $("#result").val("");
    

  });
</script>
@endsection

