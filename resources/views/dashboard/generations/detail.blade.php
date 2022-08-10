@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">  
@endsection

@section('container')
<section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{  url('') }}/dashboard/generations" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Generation Details</h1>
      <div class="section-header-button">
        <a href="{{  url('') }}/dashboard/generations/{{ $generation->slug }}/edit" class="btn btn-primary">Edit</a>
      </div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard/generations">Generations</a></div>
        <div class="breadcrumb-item">Details</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Generation Details</h2>
      <div class="row mt-sm-4 d-flex justify-content-center">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card profile-widget">
            <div class="profile-widget-header">                     
              <img alt="image" src="{{ asset('') }}assets/img/aceslogo.jpg" class="rounded-circle profile-widget-picture">
              <div class="profile-widget-items">
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label">Periode</div>
                  <div class="profile-widget-item-value">{{ $generation->periode }}</div>
                </div>
              </div>
            </div>
            <div class="profile-widget-description">
              <div class="profile-widget-name">{{ $generation->name }}</div>
                Visi : 
                <br>
                {!! $generation->visi !!}
                <br>
                Misi :
                <br>
                {!! $generation->misi !!}
            </div>
            <div class="card-footer text-center">
              <div class="font-weight-bold mb-2">Struktur Organisasi</div>
              @if ($generation->image)
                <img src="{{ asset('storage/' . $generation->image) }}" style="" class="img-fluid" alt="">
              @else
                <p>No photo</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
          <div class="col-12 col-sm-12 col-lg-10">
            <div class="card card-primary">
                <div class="card-header">
                  <h4>Frontliner Members</h4>
                  <div class="card-header-action">
                    <a href="{{  url('') }}/dashboard/frontliners/create" class="btn btn-danger btn-icon icon-right">Add <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="users-carousel">
                      @if ($frontliners->count())
                        @foreach ($frontliners as $frontliner)
                            <div>
                                <div class="user-item">
                                    @if ($frontliner->image)
                                        <img alt="image" src="{{ asset('storage/' . $frontliner->image) }}" class="img-fluid">
                                    @else
                                        <img alt="image" src="{{ asset('') }}assets/img/avatar/avatar-1.png" class="img-fluid">
                                    @endif
                                <div class="user-details">
                                    <div class="user-name">{{ $frontliner->name }}</div>
                                    <div class="text-job text-muted">{{ $frontliner->jobdesk }}</div>
                                    <div class="user-cta">
                                    <a class="btn btn-primary" href="{{  url('') }}/dashboard/frontliners/{{ $frontliner->slug }}">Details</a>
                                    </div>
                                </div>  
                                </div>
                            </div>
                        @endforeach
                      @else

                      @endif
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
    <script src="{{ asset('') }}assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('') }}assets/js/page/components-user.js"></script>  
@endsection
