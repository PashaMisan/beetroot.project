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
                        <h2 class="pageheader-title">Edit product cart</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Products tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit product cart</li>
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
                        <h5 class="card-header">Edit product card</h5>
                        <div class="card-body">
                            <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post"
                                  enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="form-group">
                                    <label for="product_name" class="col-form-label">Name</label>
                                    <input id="product_name" type="text" class="form-control" name="name"
                                           value="{{ $product->name }}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="section_id">Section</label>
                                    <select class="form-control" id="section_id" name="section_id">
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}"
                                                    @if($section->id === $product->section_id)
                                                    selected
                                                @endif
                                            >{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="product_description">Description</label>
                                    <textarea class="form-control" id="product_description" rows="3"
                                              name="description">{{ $product->description }}</textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="product_description">Text</label>
                                    <textarea class="form-control" id="text" rows="5"
                                              name="text">{{ $product->text }}</textarea>
                                </div>
                                @error('text')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="image"
                                           value="{{ asset('storage/'. $product->image) }}"
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
                                               value="{{ $product->weight }}">

                                        @error('weight')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="product_price">Price</label>
                                        <input type="text" class="form-control" id="product_price" name="price"
                                               value="{{ $product->price }}">

                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                        <label class="be-checkbox custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="status" value="1"
                                                   @if($product->status)
                                                   checked
                                                @endif
                                            ><span
                                                class="custom-control-label">
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
