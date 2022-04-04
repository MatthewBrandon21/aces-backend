@extends('layouts.dashboard')

@section('container')
  <section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="/dashboard/labs" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
      <h1>Repository Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/dashboard/labs">Labs</a></div>
        <div class="breadcrumb-item">Detail</div>
      </div>
    </div>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-10">
                <h2 class="mb-4">{{ $repository->title }}</h2>
                @if ($repository->image)
                  <img src="{{ asset('storage/' . $repository->image) }}" class="img-fluid mb-4" alt="{{ $repository->title }}" style="height: 250px">
                @else
                  <img src="https://source.unsplash.com/1200x400/?{{ $repository->labscategory->name }}" class="img-fluid mb-4" alt="{{ $repository->labscategory->name }}">
                @endif
                <p class="h5">By. <a href="/dashboard/labs?author={{ $repository->author->username }}" class="text-decoration-none">{{ $repository->author->name }}</a> in <a href="/dashboard/labs?labscategory={{ $repository->labscategory->slug }}" class="text-decoration-none">{{ $repository->labscategory->name }}</a></p>
                <p class="h6">{{ $repository->created_at->diffForHumans() }}</p>
                <div class="row d-flex justify-content-left">
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
                <article class="my-5 fs-5">
                    {!! $repository->body !!}
                </article>
            </div>
        </div>
    </div>
  </section>
@endsection
