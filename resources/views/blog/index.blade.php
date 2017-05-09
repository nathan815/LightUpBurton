@extends('blog.main_template')

@section('title','Blog')

@section('blog_content')

  @foreach($posts as $post)
    @include('blog.sections.post')
  @endforeach

@endsection