@extends('layouts.main')

@section('title','Gallery')
@section('content')

<div class="content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Videos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="gallery videos content-box-content">
        @if(empty($videos))
        <h4 class="text-center" style="margin-bottom:6px;">
            <span class="glyphicon glyphicon-facetime-video" style="font-size:70px;"></span>
            <br />
            <br />
            We don't have any videos to display right now. Check back later!
        </h4>
        @else
            @foreach($videos as $video)
                {{ $video['name'] }}
                {{ $video['url'] }}
            @endforeach
        @endif
    </div>
</div>

<div class="content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Photos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="gallery images content-box-content">
        <div class="row">
            @if(empty($images))
            <h4 class="text-center" style="margin-bottom:6px;">
                <span class="glyphicon glyphicon-camera" style="font-size:70px;"></span>
                <br />
                <br />
                We don't have any photos to display right now. Check back later!
            </h4>
            @else
                @foreach($images as $image)
                <div class="col-xs-6 col-md-4">
                    <div class="gallery-item">
                        <span class="gallery-item-caption">{{ $image['name'] }}</span>
                        <a href="#"></a>
                        <img src="{{ $image['url'] }}" class="img-responsive full-width" />
                    </div>
                    <br>
                    <br>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@section('inline_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
@endsection