@extends('layouts.dashboard')

@section('container')
  <section class="section">
    <div class="section-header">
      <h1>ACES Dashboard</h1>
    </div>
    <div class="section-body">
      <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('assets/img/welcomeback-dashboard.jpg');">
          <div class="hero-inner">
            <h2>Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="lead">Repository writing guide can be found here</p>
            <div class="mt-4">
              <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-arrow-alt-circle-right"></i> Go</a>
            </div>
          </div>
        </div>
      </div>
        <h2 class="section-title">Overview</h2>
        <p class="section-lead">
          More feature soon!
        </p>
        @cannot('admin')
          <div class="row">
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="card-body">
                  <h4>Tickets</h4>
                  <p>You can request, report, and contact admin with this feature.</p>
                  <a href="{{  url('') }}/dashboard/ticket" class="card-cta">Tickets <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-flask"></i>
                </div>
                <div class="card-body">
                  <h4>Repository ACES Labs</h4>
                  <p>Submit your repository project and get SKKM!</p>
                  <a href="{{  url('') }}/dashboard/memberlabs" class="card-cta">Repository ACES Labs <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-images"></i>
                </div>
                <div class="card-body">
                  <h4>Image Folder</h4>
                  <p>Save your image for repository post here!</p>
                  <a href="{{  url('') }}/dashboard/imagefolder" class="card-cta">Image Folder <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endcannot

        @can('admin')
          <div class="row">
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-cog"></i>
                </div>
                <div class="card-body">
                  <h4>Website Configuration</h4>
                  <p>adjust all settings about website configurations.</p>
                  <a href="{{  url('') }}/dashboard/websiteconfiguration" class="card-cta">Website Configuration <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-paper-plane"></i>
                </div>
                <div class="card-body">
                  <h4>Website Blog</h4>
                  <p>Organize and adjust all settings about website articles.</p>
                  <a href="{{  url('') }}/dashboard/posts" class="card-cta">Website Blog <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-envelope"></i>
                </div>
                <div class="card-body">
                  <h4>Contact Us Inbox</h4>
                  <p>See who reach us from contact us form.</p>
                  <a href="{{  url('') }}/dashboard/admin-contactus" class="card-cta">Contact Us Inbox <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                  <i class="fas fa-star"></i>
                </div>
                <div class="card-body">
                  <h4>CE Lecturer</h4>
                  <p>Organize our lecturers information.</p>
                  <a href="{{  url('') }}/dashboard/lecturers" class="card-cta">CE Lecturer <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endcan
        
        <div class="card-body">
          <div class="alert alert-primary alert-has-icon p-4">
            <div class="alert-icon"><i class="fas fa-question"></i></div>
            <div class="alert-body">
              <div class="alert-title">Have a problem</div>
              <p>Contact us at aces@umn.ac.id or @acesumn, and we will contact you soon!</p>
            </div>
          </div>
        </div>
    </div>
  </section>
@endsection
