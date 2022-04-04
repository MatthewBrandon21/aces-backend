@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
@endsection

@section('container')
    <section class="section">
        <div class="section-header">
        <h1>Users Management</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item">Users Management</div>
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
        <h2 class="section-title">Users Management</h2>
        <p class="section-lead">Components relating to users, lists of users and so on.</p>
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="/dashboard/users">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search something.." name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary ml-4" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                            @foreach ($users as $user)
                                <li class="media">
                                    @if ($user->image)
                                        <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('storage/' . $user->image) }}">
                                    @else
                                        <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('') }}assets/img/avatar/avatar-1.png"> 
                                    @endif
                                    <div class="media-body">
                                        @if ($user->isadmin)
                                            <div class="media-right"><div class="text-danger">Admin</div></div>
                                        @else
                                            <div class="media-right"><div class="text-primary">Member</div></div>
                                        @endif
                                        <div class="media-title mb-1">{{ $user->name }} 
                                            @if ($user->active)
                                                (active)
                                            @else
                                                (banned)
                                            @endif
                                        </div>
                                        <div class="text-time">{{ $user->username }}</div>
                                        <div class="media-description text-muted">{{ $user->email }}</div>
                                        <div class="media-links">
                                            @if ($user->isadmin)
                                                <form action="/dashboard/users/changeRole/{{ $user->username }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="isadmin" id="isadmin" value="0">
                                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Make member</button>
                                                </form>
                                            @else
                                                <form action="/dashboard/users/changeRole/{{ $user->username }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="isadmin" id="isadmin" value="1">
                                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Make admin</button>
                                                </form>
                                            @endif
                                            <div class="bullet"></div>
                                            @if ($user->active)
                                                <form action="/dashboard/users/banUser/{{ $user->username }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="active" id="active" value="0">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Banned</button>
                                                </form>
                                            @else
                                                <form action="/dashboard/users/banUser/{{ $user->username }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="active" id="active" value="1">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Unbanned</button>
                                                </form>
                                            @endif
                                            <div class="bullet"></div>
                                            <form action="/dashboard/users/{{ $user->username }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </section>
@endsection

@section('pagespecificjs')
    <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="assets/js/page/components-user.js"></script>
@endsection
