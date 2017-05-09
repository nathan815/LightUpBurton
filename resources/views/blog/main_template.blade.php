@extends('layouts.main')

@section('content')

@yield('before_content')

<div class="row">
  <div class="col-lg-7 col-md-7 main-content-left">

  @yield('blog_content')

  </div>

  <div class="col-lg-5 col-md-5 sidebar-right">

    @include('blog.sections.categories')
    @include('sections.resources')

    @yield('sidebar')

  </div>

</div>
@endsection