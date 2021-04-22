@extends('admin.layouts.app')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="form-body">
                        {!! Form::model($formObj, ['route' => 'settings.update', 'class' => 'form', 'id' => 'main-frm']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('description',null,['class' => 'form-control', 'data-required' => true,'rows'=>5]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo </label>
                                <div class="col-sm-6">
                                    <?php
                                        if((isset($formObj->id)) &&  $formObj->id >0)
                                            $img = asset('/uploads/settings/').'/'.$formObj->logo;
                                        else
                                            $img = 'http://www.urbanui.com';
                                    ?>
                                    <input type="file" class="dropify" data-default-file="{{ $img }}" name="logo" accept="image/*" id="imgValidate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo Mini</label>
                                <div class="col-sm-6">
                                    <?php
                                        if((isset($formObj->id)) &&  $formObj->id >0)
                                            $img = asset('/uploads/settings/').'/'.$formObj->logo_mini;
                                        else
                                            $img = 'http://www.urbanui.com';
                                    ?>
                                    <input type="file" class="dropify" data-default-file="{{ $img }}" name="logo_mini" accept="image/*" id="imgValidate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row pull-right">
                    <input type="submit" value="Save" class="btn btn-gray pull-right" id="submit_id" />
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#main-frm').submit(function () {

            if (true)
            {
                $('#AjaxLoaderDiv').fadeIn('slow');
                $('#submit_id').attr('disabled',true);
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
                            window.location = '{{ $list_url }}';    
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                        $('#submit_id').attr('disabled',false);
                    },
                    error: function (error) {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
        });
    });
</script>
<script src="{{asset('/themes/victory/js/dropify.js')}}"></script>
@endsection