<script src="{{ asset('admin_panel/product/product.js') }}"></script>
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
                                    <tbody class="text-center">

                                    @foreach($sections as $section)
                                        <tr class="table-primary">
                                            <td colspan="7">{{ $section->name }}</td>
                                            <td>
                                                <a href="{{ route('products.create', ['section_id'=> $section->id]) }}"
                                                   class="btn btn-rounded btn-light">Add new product</a>
                                            </td>

                                        </tr>
                                        @foreach($section->products as $key => $product)
                                            <tr>
                                                <td>{{ $product->position }}</td>
                                                <td>
                                                    <a href="{{ route('products.show', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                </td>
                                                <td class=" text-truncate col-1"
                                                    style="max-width: 100px;">{{ $product->description }}
                                                </td>

                                                {{--Ячейка отображения кнопок перемещения позиции---------------------}}
                                                <td class="p-0">
                                                    <div class="d-flex justify-content-center mt-0">
                                                        <a href="{{ route('p_position_up',
                                                                    ['position' => $product->position,
                                                                    'section' => $product->section_id]) }}"
                                                           class="f-icon"><i class="fas fa-arrow-up"></i></a>
                                                        <a href="{{ route('p_position_down',
                                                                    ['position' => $product->position,
                                                                    'section' => $product->section_id]) }}"
                                                           class="f-icon"><i class="fas fa-arrow-down"></i></a>
                                                    </div>
                                                </td>
                                                {{--------------------------------------------------------------------}}

                                                <td>{{ $product->weight }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>

                                                    @if($product->status === 1)
                                                        <a href="javascript:void(0)" class="text-success"
                                                           id="product{{$product->id}}"
                                                           onclick="changeStatus({{$product->id}})">
                                                            On
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="text-danger"
                                                           id="product{{$product->id}}"
                                                           onclick="changeStatus({{$product->id}})">
                                                            Off
                                                        </a>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ route('products.edit', ['id' => $product->id]) }}"
                                                       class="badge badge-primary">Edit</a>

                                                    <form
                                                        action="{{ route('products.destroy', ['id' => $product->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="badge badge-danger">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach


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
</script>
