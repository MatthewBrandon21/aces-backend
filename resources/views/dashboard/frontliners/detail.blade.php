@extends('layouts.dashboard')

@section('pagespecificcss')
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
@endsection

@section('container')
  <section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{  url('') }}/dashboard/frontliners" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
      <h1>Frontliner Member Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/frontliners">Frontliners</a></div>
        <div class="breadcrumb-item">Detail</div>
      </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card author-box card-primary">
                    <div class="card-body">
                      <div class="author-box-left">
                          @if ($frontliner->image)
                            <img alt="image" src="{{ asset('storage/' . $frontliner->image) }}" class="rounded-circle author-box-picture">
                          @else
                            <img alt="image" src="{{ asset('') }}assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                          @endif
                        <div class="clearfix"></div>
                        <a href="{{  url('') }}/dashboard/frontliners/{{ $frontliner->slug }}/edit" class="btn btn-primary mt-3">Edit</a>
                      </div>
                      <div class="author-box-details">
                        <div class="author-box-name">
                          <a href="#">{{ $frontliner->name }}</a>
                        </div>
                        <div class="author-box-job">{{ $frontliner->generation->name }} <div class="bullet"></div> {{ $frontliner->jobdesk }}</div>
                        <div class="author-box-description">
                            {!! $frontliner->bio !!}
                        </div>
                        <div class="mb-2 mt-3"><div class="text-small font-weight-bold">Contact</div></div>
                        <ul style="list-style-type:none">
                            @if ($frontliner->email)
                                <li><i class="fas fa-envelope" style="font-size:15px"></i> {{ $frontliner->email }}</li>
                            @endif
                            @if ($frontliner->linkedin)
                                <li><i class="fab fa-linkedin" style="font-size:15px"></i> {{ $frontliner->linkedin }}</li>
                            @endif
                            @if ($frontliner->instagram)
                                <li><i class="fab fa-instagram" style="font-size:15px"></i> {{ $frontliner->instagram }}</li>
                            @endif
                            @if ($frontliner->facebook)
                                <li><i class="fab fa-facebook" style="font-size:15px"></i> {{ $frontliner->facebook }}</li>
                            @endif
                            @if ($frontliner->twitter)
                                <li><i class="fab fa-twitter" style="font-size:15px"></i> {{ $frontliner->twitter }}</li>
                            @endif
                            @if ($frontliner->website)
                                <li><i class="fas fa-book" style="font-size:15px"></i> {{ $frontliner->website }}</li>
                            @endif
                        </ul>
                        <div class="w-100 d-sm-none"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@section('pagespecificjs')
    <script src="{{ asset('') }}assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('') }}assets/js/page/components-user.js"></script>
@endsection
