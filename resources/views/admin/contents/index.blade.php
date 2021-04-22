@extends('admin.layouts.app')

@section('content')

<!-- Advance Search -->
@include($moduleViewName.".search")

<div class="col-md-12 d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title clearfix"> {{ $module_title }} 
                        @if($btnAdd)
                            <a class="btn btn-gray pull-right" href="{{ $add_url }}">{{ $addBtnName }} </a>
                        @endif
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="server-side-datatables" class="table datatable-width">
                                    <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="12%">Title</th>
                                            <th width="15%">Description</th>
                                            <th width="10%">Size</th>
                                            <th width="10%">Quantity no</th>
                                            <th width="15%">Created At</th>
                                            <th width="15%" data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {

        $("#search-frm").submit(function () {
            oTableCustom.draw();
            return false;
        });

        $.fn.dataTableExt.sErrMode = 'throw';

        var oTableCustom = $('#server-side-datatables').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                "url": "{!! route($moduleRouteText.'.data') !!}",
                "data": function (data)
                {
                    data.search_title = $("#search-frm input[name='search_title']").val();
                }
            },
            "order": [['1', "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'size', name: 'size'},
                {data: 'qn_no', name: 'qn_no'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', orderable: false, searchable: false}
            ]
        });
    });

</script>
@endsection