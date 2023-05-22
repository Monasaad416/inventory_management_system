<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layout.head')
	</head>


<body>

    <div class="wrapper">
        <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div style="border-radius: 15px;" class="col-lg-10 col-md-10 bg-white">
                        <div class="row">
                            <div class="col text-center">
                                <h3 style="font-family: 'Cairo', sans-serif" class="mb-30 b-5 my-4 text-danger">إختر المستخدم</h3>
                            </div>
                        </div>

                        <div class="login-fancy pb-40 clearfix px-5">

                            <div class="form-inline my-4">
                                <a class="btn btn-default col-lg-2" title="مساهم" href="{{route('shareholder.login')}}">
                                    <h4>مساهم</h4>
                                </a>
                                <a class="btn btn-default col-lg-2" title="مؤسس" href="{{route('founder.login')}}">
                                    <h4>مؤسس</h4>
                                </a>
                                <a class="btn btn-default col-lg-2" title="مورد" href="{{route('supplier.login')}}">
                                    <h4>مورد</h4>
                                </a>
                                <a class="btn btn-default col-lg-2" title="عميل" href="{{route('client.login')}}">
                                    <h4>عميل</h4>
                                </a>

                                <a class="btn btn-default col-lg-2" title="ادمن" href="{{route('admin.login')}}">
                                    <h4>ادمن</h4>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
 login-->

    </div>
    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>


    <!-- toastr -->
    @yield('js')
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
