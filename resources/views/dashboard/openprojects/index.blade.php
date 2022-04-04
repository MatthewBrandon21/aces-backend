@extends('layouts.dashboard')

@section('pagespecificcss')
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/jquery-selectric/selectric.css">
@endsection

@section('container')
<section class="section">
  <div class="section-header">
    <h1>ACES Open Project</h1>
    <div class="section-header-button">
      <a href="/dashboard/openproject/create" class="btn btn-primary">Add New</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item">Open Projects</div>
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
    <h2 class="section-title">Projects</h2>
    <div class="row mb-3">
      <div class="col-md-6">
          <form action="/dashboard/openproject">
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search something.." name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary ml-4" type="submit">Search</button>
              </div>
          </form>
      </div>
    </div>
    @if ($projects->count())
      <div class="row">
        @foreach ($projects as $project)
          <div class="col-12 col-md-4 col-lg-4">
            <article class="article article-style-c">
              <div class="article-header">
                @if ($project->image)
                  <div class="article-image" data-background="{{ asset('storage/' . $project->image) }}">
                @else
                  <div class="article-image" data-background="https://source.unsplash.com/500x400/?{{ $project->title }}">
                @endif
                </div>
                @if ($project->published)
                  <div class="article-badge">
                    <div class="article-badge-item bg-primary">Published</div>
                  </div>
                @endif
              </div>
              <div class="article-details">
                <div class="article-category"><a>{{ $project->created_at->diffForHumans() }}</a></div>
                <div class="article-title">
                  <h2><a href="/dashboard/openproject/{{ $project->slug }}">{{ $project->title }}</a></h2>
                </div>
                <p>{{ $project->excerpt }}</p>
                <div class="row d-flex justify-content-center">
                  <div class="p-2">
                    <a href="/dashboard/openproject/{{ $project->slug }}/edit" class="btn btn-primary">Edit</a>
                  </div>
                  <div class="p-2">
                    <form action="/dashboard/openproject/{{ $project->slug }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                    </form>
                  </div>
                  @if ($project->published)
                    <div class="p-2">
                      <form action="/dashboard/openproject/publishConf/{{ $project->slug }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="published" id="published" value="0">
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Unpublish</button>
                      </form>
                    </div>
                  @else
                  <div class="p-2">
                    <form action="/dashboard/openproject/publishConf/{{ $project->slug }}" method="POST" class="d-inline">
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
                      <a href="/dashboard/openproject?author={{ $project->author->username }}">{{ $project->author->name }}</a>
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
      <p class="text-center fs-4">No project found</p>
    @endif
  </div>
  <div class="d-flex justify-content-end">
    {{ $projects->links() }}
  </div>
</section>
@endsection

@section('pagespecificjs')
  <script src="{{ asset('') }}assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="{{ asset('') }}assets/js/page/features-posts.js"></script>
@endsection