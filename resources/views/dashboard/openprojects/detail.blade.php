@extends('layouts.dashboard')

@section('container')
  <section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/dashboard/openproject" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
      <h1>Project Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/dashboard/openproject">Projects</a></div>
        <div class="breadcrumb-item">Detail</div>
      </div>
    </div>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-10">
                <h2 class="mb-4">{{ $project->title }}</h2>
                @if ($project->image)
                  <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid mb-4" alt="{{ $project->title }}" style="height: 250px">
                @else
                  <img src="https://source.unsplash.com/1200x400/?{{ $project->title }}" class="img-fluid mb-4" alt="{{ $project->title }}">
                @endif
                <p class="h5">By. <a href="/dashboard/openproject?author={{ $project->author->username }}" class="text-decoration-none">{{ $project->author->name }}</a></p>
                <p class="h6">{{ $project->created_at->diffForHumans() }}</p>
                <div class="row d-flex justify-content-left">
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
                <article class="my-5 fs-5">
                    {!! $project->body !!}
                </article>
            </div>
        </div>
    </div>
  </section>
@endsection
