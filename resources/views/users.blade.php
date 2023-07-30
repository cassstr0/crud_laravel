@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

            <!-- Navbar -->
            @include('layouts.navbar')


            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="margin-bottom: 70px">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard</h1>
                                <!-- Botón "Add" para mostrar el formulario -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                    style="margin-top: 10px" data-target="#event">
                                    Add User
                                </button>


                                <!-- Modal -->
                                <div class="modal fade" id="event" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>

                                                <button type="button" class="close" id="btnClose" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="calendar-data" id="calendar-data"
                                                    action="{{ route('users.store') }}" method="POST">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="email" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input type="password" class="form-control"
                                                            name="password_confirmation" id="password_confirmation"
                                                            aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <button type="submit" class="btn btn-success btn-save" id="btnSave"
                                                        name="btnSave">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        id="btnClose" name="btnClose">Close</button>
                                                </form>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard v1</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <!-- Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"
                                                data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal de edición para cada usuario -->
                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editUserModal{{ $user->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModal{{ $user->id }}Label">Edit
                                                        User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="name{{ $user->id }}">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="name{{ $user->id }}"
                                                                value="{{ $user->name }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email{{ $user->id }}">Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                id="email{{ $user->id }}"
                                                                value="{{ $user->email }}">
                                                        </div>

                                                        <!-- Agrega aquí los demás campos del usuario que deseas editar -->

                                                        <button type="submit" class="btn btn-primary">Save Changes
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>


            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.
                </strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    @endsection
