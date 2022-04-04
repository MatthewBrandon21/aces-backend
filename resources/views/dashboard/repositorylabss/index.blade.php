@extends('layouts.dashboard')

@section('pagespecificcss')
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/jquery-selectric/selectric.css">
@endsection

@section('container')
<section class="section">
  <div class="section-header">
    <h1>ACES Labs</h1>
    <div class="section-header-button">
      <a href="/dashboard/labs/create" class="btn btn-primary">Add New</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item">Labs</div>
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
    <h2 class="section-title">Repositories</h2>
    <p class="section-lead">
      Click on category or author for repositories filter.
    </p>
    <div class="row mb-3">
      <div class="col-md-6">
          <form action="/dashboard/labs">
              @if (request('labscategory'))
                  <input type="hidden" name="labscategory" value="{{ request('labscategory') }}">
              @endif
              @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
              @endif
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search something.." name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary ml-4" type="submit">Search</button>
              </div>
          </form>
      </div>
    </div>
    @if ($repositories->count())
      <div class="row">
        @foreach ($repositories as $repository)
          <div class="col-12 col-md-4 col-lg-4">
            <article class="article article-style-c">
              <div class="article-header">
                @if ($repository->image)
                  <div class="article-image" data-background="{{ asset('storage/' . $repository->image) }}">
                @else
                  <div class="article-image" data-background="https://source.unsplash.com/500x400/?{{ $repository->labscategory->name }}">
                @endif
                </div>
                @if ($repository->published)
                  <div class="article-badge">
                    <div class="article-badge-item bg-primary">Published</div>
                  </div>
                @endif
              </div>
              <div class="article-details">
                <div class="article-category"><a href="/dashboard/labs?labscategory={{ $repository->labscategory->slug }}">{{ $repository->labscategory->name }}</a> <div class="bullet"></div> <a>{{ $repository->created_at->diffForHumans() }}</a></div>
                <div class="article-title">
                  <h2><a href="/dashboard/labs/{{ $repository->slug }}">{{ $repository->title }}</a></h2>
                </div>
                <p>{{ $repository->excerpt }}</p>
                <div class="row d-flex justify-content-center">
                  <div class="p-2">
                    <a href="/dashboard/labs/{{ $repository->slug }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="p-2">
                    <form action="/dashboard/labs/{{ $repository->slug }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                    </form>
                  </div>
                  @if ($repository->published)
                    <div class="p-2">
                      <form action="/dashboard/labs/publishConf/{{ $repository->slug }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="published" id="published" value="0">
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Unpublish</button>
                      </form>
                    </div>
                  @else
                  <div class="p-2">
                    <form action="/dashboard/labs/publishConf/{{ $repository->slug }}" method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="published" id="published" value="1">
                      <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Publish</button>
                    </form>
                  </div>
                  @endif
                </div>
                <div class="article-user">
                  <img alt="image" src="{{ asset('') }}assets/img/avatar/avatar-1.png">
                  <div class="article-user-details">
                    <div class="user-detail-name">
                      <a href="/dashboard/labs?author={{ $repository->author->username }}">{{ $repository->author->name }}</a>
                    </div>
                    <div class="text-job">Web Developer</div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center fs-4">No repository found</p>
    @endif
  </div>
  <div class="d-flex justify-content-end">
    {{ $repositories->links() }}
  </div>
</section>
@endsection

@section('pagespecificjs')
  <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="{{ asset('') }}assets/js/page/features-posts.js"></script>
@endsection