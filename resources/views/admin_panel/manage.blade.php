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
                        <h2 class="pageheader-title">Staff</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin_panel_main') }}"
                                                                   class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}"
                                                                   class="breadcrumb-link">Staff</a></li>
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
                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Staff</h5>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>

                                        <td>
                                            @if (Auth::id() !== $user->id)
                                                <form action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge badge-danger">Delete</button>
                                                </form>
                                            @else
                                                -
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
                <!-- end basic table -->
                <!-- ============================================================== -->
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- basic form -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Create a new staff member</h5>
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" id="basicform" data-parsley-validate=""
                                  method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="inputUserName">Name</label>
                                    <input id="inputUserName" type="text" name="name" data-parsley-trigger="change"
                                           required="" placeholder="Enter name" autocomplete="off"
                                           class="form-control" value="{{ old('name') }}">

                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="inputEmail">Email address</label>
                                    <input id="inputEmail" type="email" name="email" data-parsley-trigger="change"
                                           required="" placeholder="Enter email" autocomplete="off"
                                           class="form-control" value="{{ old('email') }}">

                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input id="inputPassword" name="password" type="password" placeholder="Password"
                                           required=""
                                           class="form-control">

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="inputRepeatPassword">Repeat Password</label>
                                    <input id="inputRepeatPassword" name="password_confirmation"
                                           data-parsley-equalto="#inputPassword" type="password" required=""
                                           placeholder="Password" class="form-control">

                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="input-select">Select role</label>
                                    <select class="form-control" id="input-select" name="role">
                                        <option disabled selected>Choose role</option>

                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->id }}" {{ (old("role") == $role->id ? "selected":"") }}>{{ $role->name }}</option>
                                        @endforeach

                                    </select>

                                    @error('role')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="row">
                                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                    </div>
                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Create</button>
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
    </div>

@endsection
