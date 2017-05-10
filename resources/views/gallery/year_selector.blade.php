<div class="dropdown pull-right">
  <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    {{ $year ? $year : 'All Years' }}
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    @if(!is_null($year))
    <li><a href="/gallery">Show All Years</a></li>
    @endif
    
    @foreach($allYears as $year)
    <li><a href="/gallery/{{ $year }}">{{ $year }}</a></li>
    @endforeach

  </ul>
</div>
<span class="clearfix"></span>