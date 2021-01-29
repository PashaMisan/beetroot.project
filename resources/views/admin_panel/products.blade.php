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
                        <h2 class="pageheader-title">Products table</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                                                   class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Products tables</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- data table rowgroup  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Products table</h5>
                            <p>This is a table that shows the menu structure.</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table class="table" style="width:100%">
                                    <thead class="text-center">
                                    <tr class="table-active">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Position</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="products-table">

                                    {{-- Inside of the product table --}}
                                    @include('admin_panel.ajax.productTable')

                                    </tbody>
                                    <tfoot class="text-center">
                                    <tr class="table-active">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Position</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end data table rowgroup  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>

@endsection

<script>
    var change_product_status_ajax = '{{ route('change_product_status_ajax')}}';
    var csrf = '{{ csrf_token() }}';
    var change_position_route = '{{ route('p_position_change') }}';
</script>

@section('JavaScripts')
    <script src="{{ asset('admin_panel/product/product.js') }}"></script>
    <script src="{{ asset('js/helpers/fetch.js') }}"></script>
    <script src="{{ asset('admin_panel/product/changePosition.js') }}"></script>
@endsection
