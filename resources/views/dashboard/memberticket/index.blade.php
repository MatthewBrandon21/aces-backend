@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
@endsection

@section('container')
    <section class="section">
        <div class="section-header">
        <h1>User Tickets</h1>
        <div class="section-header-button">
            <a href="{{  url('') }}/dashboard/ticket/create" class="btn btn-primary">Add New</a>
          </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">User Tickets</div>
        </div>
        </div>

        <div class="section-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
                </div>
            @endif
            @if (session()->has('fail'))
                <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button>
                    {{ session('fail') }}
                </div>
                </div>
            @endif
            <h2 class="section-title">User Tickets</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1" style="width: 100%">
                                    <thead>                                 
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Timestamp</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                 
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration	 }}</td>
                                                <td>{{ $ticket->created_at }}</td>
                                                <td><a href="{{  url('') }}/dashboard/ticket/{{ $ticket->slug }}">{{ $ticket->title }}</a></td>
                                                <td>{{ $ticket->status }}</td>
                                                <td style="">
                                                    <a href="{{  url('') }}/dashboard/ticket/{{ $ticket->slug }}" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('pagespecificjs')
    <script src="{{ asset('') }}assets/modules/datatables/datatables.min.js"></script>
    <script src="{{ asset('') }}assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="{{ asset('') }}assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('') }}assets/js/page/modules-datatables.js"></script>
@endsection
