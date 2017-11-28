@foreach($images as $id => $image)
    <div class="gallery-item-container col-xs-6 col-sm-6 col-md-4" data-id="{{ $id }}">
        <div class="gallery-item">
            <span class="gallery-item-caption">{{ $image['name'] }}</span>
            <a href="{{ $image['url'] }}" title="{{ $image['name'] }}"></a>
            <img src="{{ $image['url'] }}" class="img-responsive full-width" />
        </div>
        <br>
        <br>
    </div>
@endforeach