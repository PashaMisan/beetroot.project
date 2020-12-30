@extends('admin_panel.layouts.panel')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Products card</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="breadcrumb-link">Products tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Show product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    <!-- ============================================================== -->
    <!-- card list group  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Weight: {{ $product->weight }} gm.</li>
                    <li class="list-group-item">Price: {{ $product->price }} uah.</li>
                </ul>
                <div class="card-footer p-0 text-center d-flex justify-content-center">
                    <div class="card-footer-item card-footer-item-bordered">
                        <a href="{{ route('products.index') }}" class="card-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end card list group  -->
    <!-- ============================================================== -->
@endsection
