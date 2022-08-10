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
        <a href="{{  url('') }}/dashboard/imagefolder" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Add New Image</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/imagefolder">Image Folder</a></div>
        <div class="breadcrumb-item">Add New Image</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Add New Image</h2>
      <p class="section-lead">
        On this page you can add a new image and fill in all fields.
      </p>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Add Image</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('') }}/dashboard/imagefolder" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" name="image" id="image-upload" />
                        </div>
                      </div>
                    </div>
                    @error('image')
                      <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </div>
                    </div>
                </form>
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