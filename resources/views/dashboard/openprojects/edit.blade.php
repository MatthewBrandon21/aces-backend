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
        <a href="/dashboard/openproject" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Project</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/dashboard/openproject">Projects</a></div>
        <div class="breadcrumb-item">Edit Project</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit Project</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <form method="POST" action="/dashboard/openproject/{{ $project->slug }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="title" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" class="form-control @error('title') is-invalid @enderror" required autofocus>
                            @error('title')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Slug</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $project->slug) }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mb-2">
                        <label class="col-form-label text-md-right">Content</label>
                    </div>
                    @error('body')
                      <p class="text-danger text-center">{{ $message }}</p>
                     @enderror
                    <div class="form-group row mb-4 d-flex justify-content-center">
                        <div class="col-sm-12 col-md-11">
                          <textarea class="summernote @error('body') is-invalid @enderror" name="body" id="body">{{ old('body', $project->body) }}</textarea>
                        </div>
                    </div>
                    @if ($project->image)
                        <input type="hidden" name="oldimage" value="{{ $project->image }}">
                        <div class="form-group row mb-4">
                            <label for="slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" style="height: 250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New Thumbnail</label>
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
                            <button type="submit" class="btn btn-primary">Update Project</button>
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
        fetch('/dashboard/openproject/checkSlug?title=' + title.value)
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