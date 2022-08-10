@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
@endsection

@section('container')
    <section class="section">
        <div class="section-header">
        <h1>Contact Us Inbox</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Contact Us Inbox</div>
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
            <h2 class="section-title">Contact Us Inbox</h2>
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
                                            <th>From</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                 
                                        @foreach ($contactuses as $contactus)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration	 }}</td>
                                                <td>{{ $contactus->created_at }}</td>
                                                <td><a href="{{  url('') }}/dashboard/admin-contactus/{{ $contactus->id }}">{{ $contactus->title }}</a></td>
                                                <td>{{ $contactus->name }}</td>
                                                <td>{{ $contactus->email }}</td>
                                                <td>{{ $contactus->status }}</td>
                                                <td style="">
                                                    <a href="{{  url('') }}/dashboard/admin-contactus/{{ $contactus->id }}" class="btn btn-primary">Detail</a>
                                                    <form action="{{  url('') }}/dashboard/admin-contactus/{{ $contactus->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                                                    </form>
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
