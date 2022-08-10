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
        <a href="{{  url('') }}/dashboard/frontliners" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create New Frontliner Member</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/frontliners">Frontliners</a></div>
        <div class="breadcrumb-item">Create New Member</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Create New Frontliner Member</h2>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Submit frontliner data</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('') }}/dashboard/frontliners" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" autofocus>
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
                            <input type="text" id="slug" name="slug" value="{{ old('slug', 'Auto generated') }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="jobdesk" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jobdesk</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="jobdesk" name="jobdesk" value="{{ old('jobdesk') }}" class="form-control @error('jobdesk') is-invalid @enderror" autofocus>
                            @error('jobdesk')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="generation_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Generation</label>
                        <div class="col-sm-12 col-md-7">
                        <select name="generation_id" id="generation_id" class="form-control selectric">
                          @foreach ($generations as $generation)
                            @if (old('generation_id') == $generation->id)
                              <option value="{{ $generation->id }}" selected>{{ $generation->name }}</option>
                            @else
                              <option value="{{ $generation->id }}">{{ $generation->name }}</option>
                            @endif
                          @endforeach  
                        </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center mb-2">
                        <label class="col-form-label text-md-right">Bio</label>
                    </div>
                    @error('bio')
                      <p class="text-danger text-center">{{ $message }}</p>
                     @enderror
                    <div class="form-group row mb-4 d-flex justify-content-center">
                        <div class="col-sm-12 col-md-11">
                          <textarea class="summernote @error('bio') is-invalid @enderror" name="bio" id="bio">{{ old('bio') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
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
                        <label for="email" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="linkedin" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Linkedin</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" class="form-control @error('linkedin') is-invalid @enderror">
                            @error('linkedin')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="instagram" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Instagram</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="instagram" name="instagram" value="{{ old('instagram') }}" class="form-control @error('instagram') is-invalid @enderror">
                            @error('instagram')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="facebook" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Facebook</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="facebook" name="facebook" value="{{ old('facebook') }}" class="form-control @error('facebook') is-invalid @enderror">
                            @error('facebook')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="twitter" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Twitter</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="twitter" name="twitter" value="{{ old('twitter') }}" class="form-control @error('twitter') is-invalid @enderror">
                            @error('twitter')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="website" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Website</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="website" name="website" value="{{ old('website') }}" class="form-control @error('website') is-invalid @enderror">
                            @error('website')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Create member</button>
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
        fetch('<?php echo url('')?>/dashboard/frontliners/checkSlug?name=' + name.value)
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