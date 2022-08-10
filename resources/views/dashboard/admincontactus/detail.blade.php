@extends('layouts.dashboard')

@section('pagespecificcss')
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endsection

@section('container')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{  url('') }}/dashboard/admin-contactus" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Contact Us Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/admin-contactus">Contact Us</a></div>
        <div class="breadcrumb-item">Contact Us Details</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Contact Us Details</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Contact Us Details</h4>
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <label for="created_at" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Timestamp</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" id="created_at" name="created_at" value="{{ old('created_at', $contactus->created_at) }}" class="form-control @error('created_at') is-invalid @enderror" disabled>
                    @error('created_at')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" id="name" name="name" value="{{ old('name', $contactus->name) }}" class="form-control @error('name') is-invalid @enderror" disabled>
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label for="email" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" id="email" name="email" value="{{ old('email', $contactus->email) }}" class="form-control @error('email') is-invalid @enderror" disabled>
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                  <label for="title" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                  <div class="col-sm-12 col-md-7">
                      <input type="text" id="title" name="title" value="{{ old('title', $contactus->title) }}" class="form-control @error('title') is-invalid @enderror" disabled>
                      @error('title')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>
              </div>
              <div class="form-group row mb-4">
                <label for="body" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Body</label>
                <div class="col-sm-12 col-md-7">
                    {{ old('body', $contactus->body) }}
                </div>
              </div>
            </div>
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