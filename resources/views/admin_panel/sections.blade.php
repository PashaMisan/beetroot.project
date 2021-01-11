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
                        <h2 class="pageheader-title">Sections </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('sections.index') }}"
                                                                   class="breadcrumb-link">Menu creator</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sections</li>
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
                        <h5 class="card-header">Sections</h5>
                        <div class="card-body">
                            <table class="table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                @foreach($sections as $key => $section)
                                    <tr>
                                        <th scope="row">{{ $section->position }}</th>
                                        <td class="text-center" >{{ $section->name }}</td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                <a href="{{ route('position_up', $position = $section->position) }}"
                                                   class="col-sm-6 col-md-4 col-lg-3 f-icon">
                                                    <i class="fas fa-arrow-up"></i>
                                                </a>
                                                <a href="{{ route('position_down', $position = $section->position) }}"
                                                   class="col-sm-6 col-md-4 col-lg-3 f-icon">
                                                    <i class="fas fa-arrow-down"></i></a>
                                            </div>
                                        </td>
                                        <td>

                                            <a href="{{ route('sections.edit', ['id' => $section->id]) }}"
                                               class="badge badge-primary">Edit</a>

                                            <form action="{{ route('sections.destroy', ['id' => $section->id]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge badge-danger">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                                <form action="{{ route('sections.store') }}" method="post">
                                    @csrf
                                    <tr>
                                        <th scope="row">-</th>
                                        <td>
                                            <div class="form-group">
                                                <label for="section_name" class="col-form-label"></label>
                                                <input id="section_name" type="text" class="form-control"
                                                       name="section_name">
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-rounded btn-success">Add new section</button>
                                        </td>
                                    </tr>
                                </form>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end basic table -->
            <!-- ============================================================== -->

@endsection
