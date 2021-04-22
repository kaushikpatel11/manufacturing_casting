@extends('admin.layouts.login')

@section('content')

<div class="row">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
        <div class="row w-100">
            <div class="col-lg-8 mx-auto">
                <div class="row">
                    <div class="col-lg-6 bg-white">
                        <div class="auth-form-light text-left p-5">
                            <h2>Login</h2>
                            <h4 class="font-weight-light">Hello! let's get started</h4>
                            {!! Form::open(['route' => 'check_admin_login', 'files' => true, 'class' => 'login-form pt-5', 'id' => 'parsely-frm','redirect-url' => route('admin_dashboard')]) !!}
                                    <div class="form-group">
                                        <label>Eamil</label>
                                        <input type="text" class="form-control" placeholder="Enter Email Address" name="email">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                                        <i class="mdi mdi-lock"></i>
                                    </div>
                                    <div class="mt-5">
                                        <button class="btn btn-lock btn-gray btn-lg font-weight-medium">Login</button>
                                    </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; {{ date('Y') }}  All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- row ends -->


@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.login-form').submit(function () {
            if (true)
            {
                $('#AjaxLoaderDiv').fadeIn('slow');
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                            window.location = $('.login-form').attr('redirect-url');
                        } else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
        });
    });
</script>
@stop
