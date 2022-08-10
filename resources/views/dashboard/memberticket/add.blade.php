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
        <a href="{{  url('') }}/dashboard/ticket" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create New Ticket</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/ticket">Ticket</a></div>
        <div class="breadcrumb-item">Create New Ticket</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Make new ticket</h2>
      <p class="section-lead">
        On this page you can create a new post and fill in all fields.
      </p>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Make new ticket</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('') }}/dashboard/ticket">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="title" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" autofocus>
                            @error('title')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', 'Auto generated') }}" class="form-control" hidden>
                    <div class="form-group row d-flex justify-content-center mb-2">
                      <label class="col-form-label text-md-right">Content</label>
                  </div>
                  @error('body')
                    <p class="text-danger text-center">{{ $message }}</p>
                   @enderror
                  <div class="form-group row mb-4 d-flex justify-content-center">
                      <div class="col-sm-12 col-md-11">
                        <textarea class="summernote @error('body') is-invalid @enderror" name="body" id="body">{{ old('body') }}</textarea>
                      </div>
                  </div>
                  <p>
                    After add this ticket, you cannot edit or delete this ticket. Please make sure all information submit correctly!
                  </p>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Create ticket</button>
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
  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');
    title.addEventListener('change', function(){
        fetch('<?php echo url('')?>/dashboard/ticket/checkSlug?title=' + title.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
    });
  </script>
  <script src="{{ asset('') }}assets/modules/summernote/summernote-bs4.js"></script>
  <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="{{ asset('') }}assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
  <script src="{{ asset('') }}assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="{{ asset('') }}assets/js/page/features-post-create.js"></script>
@endsection