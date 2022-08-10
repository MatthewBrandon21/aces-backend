@extends('layouts.dashboard')

@section('pagespecificcss')
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/jquery-selectric/selectric.css">
@endsection

@section('container')
<section class="section">
  <div class="section-header">
    <h1>Computer Engineering Lecturers</h1>
    <div class="section-header-button">
      <a href="{{  url('') }}/dashboard/lecturers/create" class="btn btn-primary">Add New</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item">Lecturers</div>
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
    <h2 class="section-title">Lecturers</h2>
    <div class="row mb-3">
      <div class="col-md-6">
          <form action="{{  url('') }}/dashboard/lecturers">
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search something.." name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary ml-4" type="submit">Search</button>
              </div>
          </form>
      </div>
    </div>
    @if ($celecturers->count())
      <div class="row">
        @foreach ($celecturers as $celecturer)
          <div class="col-12 col-md-4 col-lg-4">
            <article class="article article-style-c">
              <div class="article-header">
                @if ($celecturer->image)
                  <div class="article-image" data-background="{{ asset('storage/' . $celecturer->image) }}">
                @else
                  <div class="article-image" data-background="https://source.unsplash.com/500x400/?{{ $celecturer->jobdesk }}">
                @endif
                </div>
              </div>
              <div class="article-details">
                <div class="article-category"><a>{{ $celecturer->jobdesk }}</a></div>
                <div class="article-title">
                  <h2><a href="{{  url('') }}/dashboard/lecturers/{{ $celecturer->slug }}">{{ $celecturer->name }}</a></h2>
                </div>
                <div class="row d-flex justify-content-center">
                  <div class="p-2">
                    <a href="{{  url('') }}/dashboard/lecturers/{{ $celecturer->slug }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="p-2">
                    <form action="{{  url('') }}/dashboard/lecturers/{{ $celecturer->slug }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center fs-4">No data found</p>
    @endif
  </div>
  <div class="d-flex justify-content-end">
    {{ $celecturers->links() }}
  </div>
</section>
@endsection

@section('pagespecificjs')
  <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="{{ asset('') }}assets/js/page/features-posts.js"></script>
@endsection