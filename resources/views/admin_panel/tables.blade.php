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
                        <h2 class="pageheader-title">Tables</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('tables.index') }}"
                                                                   class="breadcrumb-link">Tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->

            <div class="row">
                <!-- ============================================================== -->
                <!-- basic table -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Tables</h5>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tables as $key => $table)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $table->number }}</td>

                                        <td>
                                            <form action="{{ route('tables.destroy', ['id' => $table->id]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge badge-danger">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                                <form action="{{ route('tables.store') }}" method="post">
                                    @csrf
                                    <tr>
                                        <th scope="row">-</th>
                                        <td>
                                            <div class="form-group d-flex justify-content-center">
                                                <label for="inputText3" class="col-form-label"></label>
                                                <input id="inputText3" type="number" name="number"
                                                       class="form-control w-25">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-rounded btn-success">Add new table</button>
                                        </td>
                                    </tr>

                                    @error('number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </form>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end basic table -->
                <!-- ============================================================== -->
            </div>

        </div>
    </div>

@endsection
