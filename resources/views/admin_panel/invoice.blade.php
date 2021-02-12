@extends('admin_panel.layouts.panel')

@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Order Invoice </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                       class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Invoice</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="row" id="printableArea">
                    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header p-4">
                                <a class="pt-2 d-inline-block" href="index.html">Concept</a>
                                <div class="float-right"><h3 class="mb-0">Invoice #{{ $invoice->id }}</h3>
                                    {{ $invoice->updated_at }}</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th class="right">Unit Cost</th>
                                            <th class="center">Qty</th>
                                            <th class="right">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($products[0]))
                                            @foreach($products as $key => $product)

                                                <tr>
                                                    <td class="center">{{ ++$key }}</td>
                                                    <td class="left strong">{{ $product['name'] }}</td>
                                                    <td class="right">₴{{ $product['price'] }}</td>
                                                    <td class="center">{{ $product['quantity'] }}</td>
                                                    <td class="right">₴{{ $product['fullPrice'] }}</td>
                                                </tr>

                                            @endforeach
                                        @else

                                            <tr class="text-center">
                                                <td class="center" colspan="5">No confirmed orders yet.</td>
                                            </tr>

                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                    </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                            <tr>
                                                <td class="left">
                                                    <strong class="text-dark">Total</strong>
                                                </td>
                                                <td class="right">
                                                    <strong class="text-dark">₴{{ $invoice['sum'] }}</strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header p-4">
                                <div class="d-flex justify-content-between">

                                    <div class="d-flex align-items-center" onclick="printDiv('printableArea')">
                                        <div class="btn btn-light">
                                            <i class="fas fa-print"> Print invoice</i>
                                        </div>
                                    </div>

                                    <a href="#"
                                       data-toggle="modal" data-target="#exampleModal"
                                       class="btn btn-outline-danger">Close order</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h5 class="modal-title text-danger" id="exampleModalLabel">
                                                        Warning!</h5>
                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </a>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Are you sure that the order has been paid?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-secondary"
                                                       data-dismiss="modal">Cancel</a>
                                                    <a href="{{ route('close_table', ['id' => $invoice->id]) }}"
                                                       class="btn btn-primary">Yes, I am sure</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
@endsection

<script src="{{ asset('admin_panel/invoice/invoice_page.js') }}"></script>
