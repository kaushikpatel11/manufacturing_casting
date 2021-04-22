<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from www.urbanui.com/victory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Sep 2018 12:21:13 GMT -->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($page_title) ? $page_title:env('APP_SITE_TITLE') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
        <!-- endinject -->
        <!-- datatable css -->
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" />
        <!-- end datatable css -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('/themes/victory/css/style.css?4565')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/dropify/dist/css/dropify.min.css?234567')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/themes/victory/node_modules/sweetalert2/dist/sweetalert2.min.css')}}">
        <!-- endinject -->
        <link href="{{ asset('js/') }}/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('js/') }}/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker css -->
        
        <link rel="shortcut icon" href="{{asset('/themes/victory/images/favicon.png')}}" />
        <link rel="stylesheet" href="{{asset('/css/custom.css?45678')}}">
        <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />

        @yield('styles')
    </head>
    <body {{ (\Request::is('dealer/build-order')) ? 'class=sidebar-icon-only':''}}>
        <div class="container-scroller">
            
            @include('admin.includes.header')
            
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <div class="row row-offcanvas row-offcanvas-right">
                    
                    @include('admin.includes.sidebar')
                    <div class="content-wrapper">
                        
                        @yield('content')

                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    
                    @include('admin.includes.footer')

                    {!! Form::open(['method' => 'DELETE','id' => 'global_delete_form']) !!}
                    {!! Form::hidden('id', 0,['id' => 'delete_id']) !!}
                    {!! Form::close() !!}


                    <!-- partial -->
                </div>
                <!-- row-offcanvas ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        @include('admin.includes.loader')
        
        <!-- plugins:js -->
        <script src="{{asset('/themes/victory/node_modules/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{asset('/themes/victory/node_modules/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/chart.js/dist/Chart.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/morris.js/morris.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- End plugin js for this page-->
        
        <!-- datatable js -->
        <script src="{{asset('/themes/victory/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
        <!-- enddatable js -->

        <!-- inject:js -->
        <script src="{{asset('/themes/victory/js/off-canvas.js')}}"></script>
        <script src="{{asset('/themes/victory/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('/themes/victory/js/misc.js')}}"></script>
        <script src="{{asset('/themes/victory/js/settings.js')}}"></script>
        <script src="{{asset('/themes/victory/js/todolist.js')}}"></script>
        <script type="text/javascript" src="{{asset('/js/parsley.js')}}"></script>
        <!-- endinject -->
        
        <!-- Date Picker JS-->        
        <script src="{{asset('/js/custom.js?234567')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/jquery.bootstrap-growl.min.js') }}"></script>
        <script src="{{asset('/themes/victory/node_modules/dropify/dist/js/dropify.min.js?2346')}}"></script>

        <script src="{{asset('/js/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        @if(\Request::is("sales/sales-orders") || \Request::is("admin/orders") || \Request::is("sales/sale-feedbacks/*") || \Request::is("admin/feedbacks/*") || \Request::is("dealer/feedback-complaint/*"))
        @else
        <script src="{{asset('/js/scripts/app.min.js')}}" type="text/javascript"></script>
        @endif
        
        @include('admin.includes.flashMsg')

        <script src="{{asset('/themes/victory/node_modules/sweetalert2/dist/sweetalert2.min.js')}}"></script>
      
       <!-- <script src="/themes/victory/js/avgrund.js"></script> -->
        <script src="{{asset('/js/jquery-ui.js')}}"></script>
        <script src="{{asset('/js/pages/custom.js')}}"></script>
        @yield('scripts')
        
    </body>
    <!-- Mirrored from www.urbanui.com/victory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Sep 2018 12:21:58 GMT -->
</html>
