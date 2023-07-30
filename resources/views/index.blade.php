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
            <div class="content-wrapper">
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
                                    Add Event
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editEventModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($events as $event)
                                                <form id="edit-event-form" action="{{ route('event.updateOrDelete', $event->id) }}" method="POST">
                                                    @endforeach
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="edit-event-title">Title</label>
                                                        <input type="text" class="form-control" id="edit-event-title" name="title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-event-type">Event Type</label>
                                                        <select class="form-control" id="edit-event-type" name="event_type">
                                                            <option value="">Select Event Type</option>
                                                            @foreach ($eventTypes as $eventType)
                                                            <option value="{{ $eventType->id }}" style="background-color: {{ $eventType->background }}; color: {{ $eventType->text }};">
                                                                {{ $eventType->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-event-start">Start</label>
                                                        <input type="datetime-local" class="form-control" id="edit-event-start" name="date_start">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-event-end">End</label>
                                                        <input type="datetime-local" class="form-control" id="edit-event-end" name="date_end">
                                                    </div>
                                                    <input type="hidden" id="edit-event-id" name="id">
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" id="btnUpdate">Save Changes</button>
                                                    </div>
                                                </form>

                                                @foreach ($events as $event)
                                                <form id="delete-event-form" action="{{ route('event.updateOrDelete', $event->id) }}" method="POST">
                                                    @endforeach
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
                                                    </div>
                                                </form>
                                                                                              

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="event" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Events</h5>

                                                <button type="button" class="close" id="btnClose" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form class="calendar-data" id="calendar-data"
                                                    action="{{ route('event-add') }}" method="POST">
                                                    @csrf


                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" name="title"
                                                            id="title" aria-describedby="helpId"
                                                            placeholder="Write A Title">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="event_type">Event Type</label>
                                                        <select class="form-control" name="event_type" id="event_type">
                                                            <option value="">Select Event Type</option>
                                                            @foreach ($eventTypes as $eventType)
                                                                <option value="{{ $eventType->id }}"
                                                                    style="background-color: {{ $eventType->background }}; color: {{ $eventType->text }};">
                                                                    {{ $eventType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date_start">Start</label>
                                                        <input type="datetime-local" class="form-control"
                                                            name="date_start" id="date_start" aria-describedby="helpId"
                                                            placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date_end">End</label>
                                                        <input type="datetime-local" class="form-control" name="date_end"
                                                            id="date_end" aria-describedby="helpId" placeholder="">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-save"
                                                            id="btnSave" name="btnSave">Save</button>
                                                    </div>
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
                    <!-- /.content-header -->
                    <!-- Main content -->
                    <section class="content" style="margin-bottom: 70px">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->
                            <!-- Calendar -->
                            <div class="container">
                                <h1>Calendar</h1>
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                <div id="calendar"></div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                </div>
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
