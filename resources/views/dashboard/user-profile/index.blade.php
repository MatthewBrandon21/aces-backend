@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap-social/bootstrap-social.css">
@endsection

@section('container')
    <section class="section">
        <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
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
        <h2 class="section-title">Hi, {{ $user->name }}</h2>
        <p class="section-lead">
            Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                @if ($user->image)
                    <img alt="image" src="{{ asset('storage/' . $user->image) }}" class="rounded-circle profile-widget-picture">
                @else
                    <img alt="image" src="{{ asset('') }}assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                @endif                     
                </div>
                <div class="profile-widget-description">
                <div class="profile-widget-name">{{ $user->name }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $user->username }}</div></div>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form action="/dashboard/profile/{{ $user->username }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">                               
                            <div class="form-group col-md-6 col-12">
                                <label for="name">name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="form-group col-md-6 col-12">
                                <label for="image">Profile picture</label>
                                <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="image" id="image-upload" />
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        <div class="row mt-sm-4 d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form action="/dashboard/profile/changePassword/{{ $user->username }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">                               
                            <div class="form-group col-md-6 col-12">
                                <label for="oldpassword">Old password</label>
                                <input type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" id="oldpassword"required>
                                <div class="invalid-feedback">
                                    Please fill in the old password
                                </div>
                                @error('oldpassword')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="password">New password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                                <div class="invalid-feedback">
                                    Please fill in the new password
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="passwordconfirm">Repeat new password</label>
                                <input type="password" class="form-control @error('passwordconfirm') is-invalid @enderror" name="passwordconfirm" id="passwordconfirm" required>
                                <div class="invalid-feedback">
                                    Please fill in the confirmation new password
                                </div>
                                @error('passwordconfirm')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('pagespecificjs')
    <script src="{{ asset('') }}assets/modules/summernote/summernote-bs4.js"></script>
    <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="{{ asset('') }}assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="{{ asset('') }}assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="{{ asset('') }}assets/js/page/features-post-create.js"></script>
@endsection
