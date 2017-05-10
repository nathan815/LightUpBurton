@extends('layouts.main')

@section('title','Gallery')
@section('content')

<div class="gallery videos content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Videos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="content-box-content">
        <div class="row">
            @if(empty($videos))
            <h4 class="text-center" style="margin-bottom:6px;">
                <span class="glyphicon glyphicon-facetime-video" style="font-size:70px;"></span>
                <br />
                <br />
                We don't have any videos to display right now. Check back later!
            </h4>
            @else
                @foreach($videos as $video)
                    <div class="col-xs-6 col-md-4 col-lg-4">
                        <div class="gallery-item">
                            <span class="gallery-item-caption">{{ $video['name'] }}</span>
                            <a href="https://www.youtube.com/watch?v={{ $video['youtubeId'] }}" title="{{ $video['name'] }}"></a>
                            <img src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/0.jpg" class="img-responsive full-width" />
                        </div>
                        <br>
                        <br>
                    </div>
                @endforeach
            @endif
        </div><!--/.row-->
    </div>
</div>

<div class="gallery images content-box with-header">
    <div class="content-box-header">
        <h3 class="pull-left">Pictures</h3>
        @include('gallery.year_selector')
    </div>
    <div class="content-box-content">
        <div class="row">
            @if(empty($images))
            <h4 class="text-center" style="margin-bottom:6px;">
                <span class="glyphicon glyphicon-camera" style="font-size:70px;"></span>
                <br />
                <br />
                We don't have any pictures to display right now. Check back later!
            </h4>
            @else
                @foreach($images as $image)
                <div class="col-xs-6 col-md-4">
                    <div class="gallery-item">
                        <span class="gallery-item-caption">{{ $image['name'] }}</span>
                        <a href="{{ $image['url'] }}" title="{{ $image['name'] }}"></a>
                        <img src="{{ $image['url'] }}" class="img-responsive full-width" />
                    </div>
                    <br>
                    <br>
                </div>
                @endforeach
            @endif
        </div><!--/.row-->
    </div><!--/.content-box-content-->
</div>

@endsection

@section('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endsection

@section('inline_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
    var options = {
        delegate: '.gallery-item a',
        type: 'image',
        gallery: {
            enabled: true
        },
        key: 'images',
        removalDelay: 300,
        mainClass: 'mfp-fade'
    };
    $('.gallery.images').magnificPopup(options);
    options.type = 'iframe';
    $('.gallery.videos').magnificPopup(options);
</script>
@endsection