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
                            <h2 class="pageheader-title">Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel
                                mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                       class="breadcrumb-link">Dashboard</a>
                                        </li>
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
                    <!-- ============================================================== -->
                    <!-- recent orders  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Table status</h5>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">#</th>
                                            <th class="border-0">Table number</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0">Waiter</th>
                                            <th class="border-0">Open time</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tables as $key => $table)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $table->number  }}</td>

                                                @if($table->order)
                                                    <td>
                                                    <span class="mr-2">
                                                        <span class="badge-dot badge-success"></span>
                                                        Active
                                                    </span></td>
                                                    <td>{{ $table->getWaiterName()}}</td>
                                                    <td>{{ $table->order->created_at }}</td>
                                                @else
                                                    <td>
                                                    <span class="mr-2">
                                                        <span class="badge-dot badge-info"></span>
                                                        Free
                                                    </span></td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end recent orders  -->
                    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                        <!-- ============================================================== -->
                        <!-- top perfomimg  -->
                        <!-- ============================================================== -->
                        <div class="card">
                            <h5 class="card-header text-center">Waiters</h5>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table no-wrap p-table text-center">
                                        <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">Name</th>
                                            <th class="border-0">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($waiters as $waiter)
                                            <tr>
                                                <td>{{ $waiter->name }}</td>
                                                <td>
                                                    @if($waiter->isOnline())
                                                        <span class="mr-2">
                                                        <span class="badge-dot badge-success">
                                                        </span>Online</span>
                                                    @else
                                                        <span class="mr-2">
                                                            <span class="badge-dot badge-danger"></span>Offline</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end top perfomimg  -->
                        <!-- ============================================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



