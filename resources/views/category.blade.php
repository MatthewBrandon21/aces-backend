@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Post Category : {{ $category }}</h1>
    @foreach ($posts as $post)
        <article class="mb-5 border-bottom">
            <h2>
                <a href="/blog/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a>
            </h2>
            <h5>By : <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a></h5>
            <p>{{ $post->excerpt }}</p>
        </article>
    @endforeach
@endsection
