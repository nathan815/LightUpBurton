@foreach($videos as $id => $video)
    <div class="gallery-item-container col-xs-6 col-sm-6 col-md-4" data-id="{{ $id }}">
        <div class="gallery-item">
            <span class="gallery-item-caption">{{ $video['name'] }}</span>
            <a href="https://www.youtube.com/watch?v={{ $video['youtubeId'] }}" title="{{ $video['name'] }}"></a>
            <img src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/0.jpg" class="img-responsive full-width" />
        </div>
        <br>
        <br>
    </div>
@endforeach