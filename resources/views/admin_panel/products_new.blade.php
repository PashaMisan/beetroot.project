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
                        <h2 class="pageheader-title">Add new product</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Products tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- ============================================================== -->
                <!-- basic form -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Add new product</h5>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name" class="col-form-label">Name</label>
                                    <input id="product_name" type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group " style="display: none;">
                                    <label for="section_id" class="col-form-label">Section_id</label>
                                    <input id="section_id" type="text" class="form-control " name="section_id"
                                           value="{{ $section_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Description</label>
                                    <textarea class="form-control" id="description" rows="3"
                                              name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Text</label>
                                    <textarea class="form-control" id="text" rows="5"
                                              name="text"></textarea>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Weight</label>
                                    <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                        <input id="product_weight" type="text" class="form-control"
                                               name="weight">
                                    </div>
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Price</label>
                                    <div class="col-sm-4 col-lg-3">
                                        <input id="product_price" type="text" class="form-control" name="price">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                        <label class="be-checkbox custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="status" value="1">
                                            <span class="custom-control-label">
                                                Add to menu immediately
                                            </span>
                                        </label>
                                    </div>

                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                            <a href="{{ route('products.index') }}" class="btn btn-space btn-secondary">Cancel</a>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end basic form -->
                <!-- ============================================================== -->
            </div>
        </div>
@endsection
