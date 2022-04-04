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
        <a href="/dashboard/generations" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Generation</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/dashboard/generations">Generations</a></div>
        <div class="breadcrumb-item">Edit generation</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Edit generation</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit generation</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/dashboard/generations/{{ $generation->slug }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="name" name="name" value="{{ old('name', $generation->name) }}" class="form-control @error('name') is-invalid @enderror" autofocus>
                            @error('name')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Slug</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="slug" name="slug" value="{{ old('slug', $generation->slug) }}" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="periode" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Periode</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="periode" name="periode" value="{{ old('periode', $generation->periode) }}" class="form-control @error('periode') is-invalid @enderror" autofocus>
                          @error('periode')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mb-2">
                      <label class="col-form-label text-md-right">Visi</label>
                    </div>
                    @error('visi')
                      <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                    <div class="form-group row mb-4 d-flex justify-content-center">
                        <div class="col-sm-12 col-md-11">
                          <textarea class="summernote @error('visi') is-invalid @enderror" name="visi" id="visi">{{ old('visi', $generation->visi) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mb-2">
                      <label class="col-form-label text-md-right">Misi</label>
                    </div>
                    @error('misi')
                      <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                    <div class="form-group row mb-4 d-flex justify-content-center">
                        <div class="col-sm-12 col-md-11">
                          <textarea class="summernote @error('misi') is-invalid @enderror" name="misi" id="misi">{{ old('misi', $generation->misi) }}</textarea>
                        </div>
                    </div>
                    @if ($generation->image)
                        <input type="hidden" name="oldimage" value="{{ $generation->image }}">
                        <div class="form-group row mb-4">
                            <label for="slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old Struktur Organisasi</label>
                            <div class="col-sm-12 col-md-7">
                                <img src="{{ asset('storage/' . $generation->image) }}" alt="{{ $generation->title }}" style="height: 250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New Struktur Organisasi</label>
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
                            <button type="submit" class="btn btn-primary">Update generation</button>
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
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    name.addEventListener('change', function(){
        fetch('/dashboard/generations/checkSlug?name=' + name.value)
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