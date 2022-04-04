@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h2 class="mb-4">{{ $post->title }}</h2>
                <h5>By. <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a></h5>
                <h5 class="mb-5">Category : <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></h5>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}">
                @else
                    <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
                @endif
                <article class="my-5 fs-5">
                    {!! $post->body !!}
                </article>
                <a href="/blog" class="text-decoration-none">Back to blog</a>
            </div>
        </div>
    </div>
@endsection
