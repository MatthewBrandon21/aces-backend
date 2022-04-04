@extends('layouts.dashboard')

@section('container')
  <section class="section">
    <div class="section-header">
      <h1>Welcome back, {{ auth()->user()->name }}</h1>
    </div>
    <div class="section-body">
    </div>
  </section>
@endsection
