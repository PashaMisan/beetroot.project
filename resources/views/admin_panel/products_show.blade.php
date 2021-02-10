@extends('admin_panel.layouts.panel')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <!-- ============================================================== -->
            <!-- Page header -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Products card</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Products tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Show product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End page header -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- image cards  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <img class="img-fluid" src="{{ asset('storage/'. $product->image) }} " alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <div class="card-text">
                                Short description: <p>{{ $product->description }}</p>
                                About: <p>{!! $product->text !!}</p>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>Weight: {{ $product->weight }} gm.</div>
                                    <div>Price: {{ $product->price }} uah.</div>
                                </div>
                            </li>
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
            <!-- end image cards  -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection
