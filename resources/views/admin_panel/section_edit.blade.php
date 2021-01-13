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
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">

                                @foreach($sections as $key => $uniqSection)
                                    @if($uniqSection->id === $section->id)

                                        <form action="{{ route('sections.update', ['id' => $uniqSection->id]) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')
                                            <tr>
                                                <th scope="row">{{ $uniqSection->position }}</th>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="edit_section_name" class="col-form-label"></label>
                                                        <input id="edit_section_name" type="text" class="form-control"
                                                               name="name"
                                                               value="{{ $uniqSection->name }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('sections.index') }}" class="badge badge-danger">
                                                        Cancel
                                                    </a>
                                                    <button class="badge badge-success">Save</button>
                                        </form>

                                    @else

                                        <tr>
                                            <th scope="row">{{ $uniqSection->position }}</th>
                                            <td class="text-center">{{ $uniqSection->name }}</td>
                                            <td></td>
                                        </tr>

                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end basic table -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
