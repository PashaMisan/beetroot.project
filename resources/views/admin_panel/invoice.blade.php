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
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header p-4">
                                <a class="pt-2 d-inline-block" href="index.html">Concept</a>

                                <div class="float-right"> <h3 class="mb-0">Invoice #1</h3>
                                    Date: 3 Dec, 2020</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th class="right">Unit Cost</th>
                                            <th class="center">Qty</th>
                                            <th class="right">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td class="left strong">Origin License</td>
                                            <td class="left">Extended License</td>
                                            <td class="right">$1500,00</td>
                                            <td class="center">1</td>
                                            <td class="right">$1500,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">2</td>
                                            <td class="left">Custom Services</td>
                                            <td class="left">Instalation and Customization (cost per hour)</td>
                                            <td class="right">$110,00</td>
                                            <td class="center">20</td>
                                            <td class="right">$22.000,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">3</td>
                                            <td class="left">Hosting</td>
                                            <td class="left">1 year subcription</td>
                                            <td class="right">$309,00</td>
                                            <td class="center">1</td>
                                            <td class="right">$309,00</td>
                                        </tr>
                                        <tr>
                                            <td class="center">4</td>
                                            <td class="left">Platinum Support</td>
                                            <td class="left">1 year subcription 24/7</td>
                                            <td class="right">$5.000,00</td>
                                            <td class="center">1</td>
                                            <td class="right">$5.000,00</td>
                                        </tr>
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
                                                    <strong class="text-dark">Subtotal</strong>
                                                </td>
                                                <td class="right">$28,809,00</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong class="text-dark">Discount (20%)</strong>
                                                </td>
                                                <td class="right">$5,761,00</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong class="text-dark">VAT (10%)</strong>
                                                </td>
                                                <td class="right">$2,304,00</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong class="text-dark">Total</strong>
                                                </td>
                                                <td class="right">
                                                    <strong class="text-dark">$20,744,00</strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
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
