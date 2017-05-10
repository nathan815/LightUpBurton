@extends('layouts.main')

@section('title','Gallery')
@section('content')

<div class="content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Videos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="gallery content-box-content">
        @foreach($videos as $video)
            {{ $video['name'] }}
            {{ $video['url'] }}
        @endforeach
    </div>
</div>

<div class="content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Photos</h3>

        @include('gallery.year_selector')

    </div>
    <div class="gallery content-box-content">
        @foreach($images as $image)
            {{ $image['name'] }}
            <img src="{{ $image['url'] }}" />
        @endforeach
    </div>
</div>

@endsection

@section('inline_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
@endsection