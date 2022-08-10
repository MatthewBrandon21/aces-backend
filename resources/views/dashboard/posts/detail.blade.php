@extends('layouts.dashboard')

@section('container')
  <section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{  url('') }}/dashboard/posts" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
      <h1>Blog Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{  url('') }}/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{  url('') }}/dashboard/posts">Posts</a></div>
        <div class="breadcrumb-item">Detail</div>
      </div>
    </div>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-10">
                <h2 class="mb-4">{{ $post->title }}</h2>
                @if ($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-4" alt="{{ $post->title }}" style="height: 250px">
                @else
                  <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" class="img-fluid mb-4" alt="{{ $post->category->name }}">
                @endif
                <p class="h5">By. <a href="{{  url('') }}/dashboard/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="{{  url('') }}/dashboard/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
                <p class="h6">{{ $post->created_at->diffForHumans() }}</p>
                <div class="row d-flex justify-content-left">
                    <div class="p-2">
                      <a href="{{  url('') }}/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="p-2">
                      <form action="{{  url('') }}/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('This action cannot be undone! Are you sure?')">Delete</button>
                      </form>
                    </div>
                    @if ($post->published)
                      <div class="p-2">
                        <form action="{{  url('') }}/dashboard/posts/publishConf/{{ $post->slug }}" method="POST" class="d-inline">
                          @csrf
                          <input type="hidden" name="published" id="published" value="0">
                          <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Unpublish</button>
                        </form>
                      </div>
                    @else
                    <div class="p-2">
                      <form action="{{  url('') }}/dashboard/posts/publishConf/{{ $post->slug }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="published" id="published" value="1">
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Publish</button>
                      </form>
                    </div>
                    @endif
                  </div>
                <article class="my-5 fs-5">
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
  </section>
@endsection
