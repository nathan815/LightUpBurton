@extends('blog.main_template')

@section('title', 'Blog: ' . $post['title'])

@section('before_content')
<ol class="breadcrumb">
  <li><a href="/blog">Blog</a></li>
  <li class="active">Post: <b>{{ $post['title'] }}</b></li>
</ol>
@endsection

@section('blog_content')

    @include('blog.sections.post')

@endsection