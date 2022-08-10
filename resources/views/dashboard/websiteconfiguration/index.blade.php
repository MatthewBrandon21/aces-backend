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
        <a href="{{  url('') }}/dashboard/websiteconfiguration" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Website Configuration</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item">Website Configuration</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Website Configuration</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Website Configuration</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('') }}/dashboard/websiteconfiguration/{{ $configuration->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group row mb-4">
                        <label for="instagram" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Instagram</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $configuration->instagram) }}" class="form-control @error('instagram') is-invalid @enderror" autofocus>
                            @error('instagram')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="twitter" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Twitter</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="twitter" name="twitter" value="{{ old('twitter', $configuration->twitter) }}" class="form-control @error('twitter') is-invalid @enderror" autofocus>
                          @error('twitter')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="facebook" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Facebook</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $configuration->facebook) }}" class="form-control @error('facebook') is-invalid @enderror" autofocus>
                          @error('facebook')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="email" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="email" name="email" value="{{ old('email', $configuration->email) }}" class="form-control @error('email') is-invalid @enderror" autofocus>
                          @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="generation_slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Generation Now</label>
                      <div class="col-sm-12 col-md-7">
                      <select name="generation_slug" id="generation_slug" class="form-control selectric">
                        @foreach ($generations as $generation)
                          @if (old('generation_slug', $configuration->generation_slug) == $generation->slug)
                            <option value="{{ $generation->slug }}" selected>{{ $generation->name }}</option>
                          @else
                            <option value="{{ $generation->slug }}">{{ $generation->name }}</option>
                          @endif
                        @endforeach  
                      </select>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="header_hero" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hero Header</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="header_hero" name="header_hero" value="{{ old('header_hero', $configuration->header_hero) }}" class="form-control @error('header_hero') is-invalid @enderror" autofocus>
                          @error('header_hero')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="announcement_title" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Announcement Title</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="announcement_title" name="announcement_title" value="{{ old('announcement_title', $configuration->announcement_title) }}" class="form-control @error('announcement_title') is-invalid @enderror" autofocus>
                          @error('announcement_title')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="announcement_link" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Announcement Link</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" id="announcement_link" name="announcement_link" value="{{ old('announcement_link', $configuration->announcement_link) }}" class="form-control @error('announcement_link') is-invalid @enderror" autofocus>
                          @error('announcement_link')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    @if ($configuration->hero_image)
                        <input type="hidden" name="oldimage" value="{{ $configuration->hero_image }}">
                        <div class="form-group row mb-4">
                            <label for="slug" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old New Hero Image</label>
                            <div class="col-sm-12 col-md-7">
                                <img src="{{ asset('storage/' . $configuration->hero_image) }}" alt="hero-image" style="height: 250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New New Hero Image</label>
                        <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="hero_image" id="image-upload" />
                        </div>
                        </div>
                    </div>
                    @error('hero_image')
                        <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Update Configuration</button>
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