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

                            @error('section_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="product_name" class="col-form-label">Name</label>
                                    <input id="product_name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group " style="display: none;">
                                    <label for="section_id" class="col-form-label">Section_id</label>
                                    <input id="section_id" type="text" class="form-control " name="section_id"
                                           value="{{ $section_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Description</label>
                                    <textarea class="form-control" id="description" rows="3"
                                              name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="product_description">Text</label>
                                    <textarea class="form-control" id="text" rows="5"
                                              name="text">{{ old('text') }}</textarea>
                                </div>
                                @error('text')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="image"
                                           onchange="document.getElementById('image-lable').innerHTML = 'Image was uploaded successfully';">
                                    <label id="image-lable" class="custom-file-label" for="customFile">Upload
                                        image</label>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="product_weight">Weight</label>
                                        <input type="text" class="form-control" id="product_weight" name="weight"
                                               value="{{ old('weight') }}">

                                        @error('weight')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="product_price">Price</label>
                                        <input type="text" class="form-control" id="product_price" name="price"
                                               value="{{ old('price') }}">

                                        @error('price')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror

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
