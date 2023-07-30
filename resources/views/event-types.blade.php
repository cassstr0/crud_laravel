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
                                    Add Event Type
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
                                                    action="{{ route('event-types.store') }}" method="POST">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="background">Background</label>
                                                        <input type="color" class="form-control" name="background"
                                                            id="background" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="border">Border</label>
                                                        <input type="color" class="form-control" name="border"
                                                            id="border" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="text">Text</label>
                                                        <input type="color" class="form-control" name="text"
                                                            id="text" aria-describedby="helpId" placeholder="">
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
                                    <th>Background</th>
                                    <th>Border</th>
                                    <th>Text</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventTypes as $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>
                                            <div style="width: 50px; height: 50px; background-color: {{ $event->background }}"></div>
                                            {{ $event->background }}
                                        </td>
                                        <td>
                                            <div style="width: 50px; height: 50px; background-color: {{ $event->border }}"></div>
                                            {{ $event->border }}
                                        </td>
                                        <td>
                                            <div style="width: 50px; height: 50px; background-color: {{ $event->text }}"></div>
                                            {{ $event->text }}
                                        </td>
                                        
                        
                                        <td>
                                            <a href="{{ route('event-types.edit', $event->id) }}" class="btn btn-primary"
                                                data-toggle="modal" data-target="#editEventModal{{ $event->id }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('event-types.destroy', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                
                                    <!-- Modal de edición para cada evento -->
                                    <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editEventModal{{ $event->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editEventModal{{ $event->id }}Label">Edit Event</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('event-types.update', $event->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                        
                                                        <div class="form-group">
                                                            <label for="name{{ $event->id }}">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="name{{ $event->id }}"
                                                                value="{{ $event->name }}">
                                                        </div>
                        
                                                        <div class="form-group">
                                                            <label for="background{{ $event->id }}">Background</label>
                                                            <input type="color" class="form-control" name="background"
                                                                id="background{{ $event->id }}"
                                                                value="{{ $event->background }}">
                                                        </div>
                        
                                                        <div class="form-group">
                                                            <label for="border{{ $event->id }}">Border</label>
                                                            <input type="color" class="form-control" name="border"
                                                                id="border{{ $event->id }}"
                                                                value="{{ $event->border }}">
                                                        </div>
                        
                                                        <div class="form-group">
                                                            <label for="text{{ $event->id }}">Text</label>
                                                            <input type="color" class="form-control" name="text"
                                                                id="text{{ $event->id }}"
                                                                value="{{ $event->text }}">
                                                        </div>
                        
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                <strong>
                    &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.
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
