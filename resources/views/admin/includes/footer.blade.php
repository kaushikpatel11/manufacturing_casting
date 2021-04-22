<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{ date('Y') }} <a href="#">Admin Panel</a>. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Admin Panel <i class="mdi mdi-heart text-danger"></i></span>
    </div>
</footer>
<div id="AjaxLoaderDiv" style="display: none;z-index:99999 !important;">
    <div style="width:100%; height:100%; left:0px; top:0px; position:fixed; opacity:0; filter:alpha(opacity=40); background:#000000;z-index:999999999;">
    </div>
    <div style="float:left;width:100%; left:0px; top:50%; text-align:center; position:fixed; padding:0px; z-index:999999999;">
        <img src="{{ asset('/images/ajax-loader.gif') }}">
        </center>
    </div>
</div>