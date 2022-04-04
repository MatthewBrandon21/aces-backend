@extends('layouts.main')

@section('container')
    <h1 class="mb-4">{{ $title }}</h1>  
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="/blog">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search something.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <h2 class="mb-5"><a href="/categories" class="btn btn-primary text-decoration-none">Categories</a></h2>  

    @if ($posts->count())
        <div class="container">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            @else
                                <img src="https://source.unsplash.com/500x400/?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                            @endif
                            <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"><small class="text-muted">By. <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
                                in <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a>. 
                                Last updated {{ $post->created_at->diffForHumans() }}</small></p>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a href="/blog/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No post found</p>
    @endif

    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>

@endsection
