@extends('layouts.main')

@section('title','Gallery')
@section('content')

<div class="gallery videos content-box with-header" data-type="videos" data-year="{{ $year }}">
    <div class="content-box-header">
        <h3 class="pull-left">Videos</h3>
        @include('gallery.year_selector')
    </div>
    <div class="content-box-content">
        @if(empty($videos))
        <h4 class="text-center" style="margin-bottom:6px;">
            <span class="glyphicon glyphicon-facetime-video" style="font-size:70px;"></span>
            <br /><br />
            There aren't any videos to display at this time. Check back later!
            <br /><br />
        </h4>
        @else
            <div class="row items">
                @include('gallery.videos')
            </div>
            @include('gallery.load_more_btn')
        @endif
    </div>
</div>

<div class="gallery images content-box with-header" data-type="images" data-year="{{ $year }}">
    <div class="content-box-header">
        <h3 class="pull-left">Pictures</h3>
        @include('gallery.year_selector')
    </div>
    <div class="content-box-content">
        @if(empty($images))
        <h4 class="text-center" style="margin-bottom:6px;">
            <span class="glyphicon glyphicon-camera" style="font-size:70px;"></span>
            <br /><br />
            There aren't any pictures to display at this time. Check back later!
            <br /><br />
        </h4>
        @else
            <div class="row items">
                @include('gallery.images')
            </div>
            @include('gallery.load_more_btn')
        @endif
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