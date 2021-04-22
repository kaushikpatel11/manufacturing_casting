@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-md-center">
                    <i class="mdi mdi-chart-line-stacked icon-lg text-success"></i>
                    <div class="ml-3">
                        <p class="mb-0">Banner</p>
                        <h6>{{ $banner_count }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-md-center">
                    <i class="mdi mdi-basket icon-lg icon-lg text-warning"></i>
                    <div class="ml-3">
                        <p class="mb-0">Products</p>
                        <h6>{{ $product_count }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-md-center">
                    <i class="mdi mdi-diamond icon-lg text-info"></i>
                    <div class="ml-3">
                        <p class="mb-0">Content</p>
                        <h6>{{ $content_count }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

@endsection



