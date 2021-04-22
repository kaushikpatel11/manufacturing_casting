<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ isset($page_title) ? $page_title:env('APP_SITE_TITLE') }}</title>
        
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('/themes/victory/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}">
        <!-- endinject -->
        
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('/themes/victory/css/style.css?451212')}}">
        <!-- endinject -->
        <link rel="stylesheet" href="{{asset('/css/custom.css?3456789098765')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
        @yield('styles')
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper">                
                @yield('content')
            </div>
        </div>
        
        @include('admin.includes.loader')
        
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{asset('/themes/victory/node_modules/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/themes/victory/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="{{asset('/themes/victory/js/off-canvas.js')}}"></script>
        <script src="{{asset('/themes/victory/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('/themes/victory/js/misc.js')}}"></script>
        <script src="{{asset('/themes/victory/js/settings.js')}}"></script>
        <script src="{{asset('/themes/victory/js/todolist.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.bootstrap-growl.min.js') }}"></script>
        <!-- endinject -->
        @yield('scripts')
    </body>    
</html>
