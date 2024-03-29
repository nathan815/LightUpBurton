<div class="dropdown pull-right">
  <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    {{ $year ? $year : 'All Years' }}
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li class="dropdown-header">Filter by Year</li>

    @if(!is_null($year))
    <li><a href="/gallery">All Years</a></li>
    @endif
    
    @foreach($allYears as $y)
    <li><a href="/gallery/{{ $y }}" class="{{ $y == $year ? 'bold' : '' }}">{{ $y }}</a></li>
    @endforeach

  </ul>
</div>
<span class="clearfix"></span>