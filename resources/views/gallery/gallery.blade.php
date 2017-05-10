@extends('layouts.main')

@section('title','Gallery')
@section('content')

<div class="content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Videos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="gallery content-box-content">
        @if(empty($videos))
        <h4 class="text-center" style="margin-bottom:6px;">
            <span class="glyphicon glyphicon-facetime-video" style="font-size:70px;"></span>
            <br />
            <br />
            We don't have any videos to display right now. Check back later!
        </h4>
        @endif

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

        @if(empty($images))
        <h4 class="text-center" style="margin-bottom:6px;">
            <span class="glyphicon glyphicon-camera" style="font-size:70px;"></span>
            <br />
            <br />
            We don't have any photos to display right now. Check back later!
        </h4>
        @endif

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