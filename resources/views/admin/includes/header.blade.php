<?php 
$setting_obj = \App\Setting::latest()->first();
$logo_img = asset('/themes/victory/images/logo.svg');
$logo_min_img = asset('/themes/victory/images/logo-mini.svg');
if($setting_obj){
    $logo_img = asset('/uploads/settings/'.$setting_obj->logo);
    $logo_min_img = asset('/uploads/settings/'.$setting_obj->logo_mini);
}
?>
<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-dark">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{  route('admin_dashboard') }}"><img src="{{$logo_img}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{  route('admin_dashboard') }}"><img src="{{$logo_min_img}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        @if(!Request::is('*/dashboard'))
        <a href="{{ URL::previous() }}" style="text-decoration: none !important; color: white;" class="navbar-toggler navbar-toggler align-self-center">
            <span class="icon-arrow-left"></span>
        </a>
        @endif
        <span>{{ $title }}</span>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="{{ route('admin_logout') }}" title="Log Out">
                    <i class="icon-logout"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
