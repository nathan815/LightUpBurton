@extends('layouts.main')

@section('title', 'Information')

@section('content')

<div class="row">

    <div class="col-lg-7 col-md-7 main-content-left">
        
        <div class="content-box with-header">
            <div class="content-box-header">
                <h3>Schedule</h3>
            </div>
            <div class="content-box-content">
                <p>Beginning November 25th and ending December 30th, the show runs everyday 6pm to 10pm. You can stop by any time during these hours.</p>
            </div>
        </div>

        <div class="content-box with-header">
            <div class="content-box-header">
                <h3>Listening</h3>
            </div>
            <div class="content-box-content">
                <p>To listen to the music of our light show, all you have to do is tune your radio to 92.1 FM. It's that easy!</p>
                <p><small>
                Wondering how it works? See the Q&amp;A 
                <span class="hidden-xs hidden-sm">to the right.</span>
                <span class="hidden-md hidden-lg">below.</span>
                </small></p>
            </div>
        </div>

        <div class="content-box with-header">
            <div class="content-box-header">
                <h3>Location</h3>
            </div>
            <div class="content-box-content google-map-location">
                <iframe
                  width="100%"
                  height="300"
                  frameborder="0" style="border:0"
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAW3dKqEFcsAHU3-UqaseeQhF65cL35nKk
                    &q=2197+Howe+Rd+Burton+MI+48519" allowfullscreen>
                </iframe>
            </div>
        </div>

    </div>

    <div class="col-lg-5 col-md-5 sidebar-right">

        <div class="content-box with-header">
            <div class="content-box-header">
                <h3>General Q&amp;A</h3>
            </div>
            <div class="content-box-content">
                
                <div class="panel-group" id="faq" role="tablist" aria-multiselectable="true">
                  
                  @foreach($faq as $key => $item )
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="q_{{$key}}">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#faq" href="#a_{{$key}}" aria-expanded="false" aria-controls="a_{{$key}}">
                          {!! $item['q'] !!}
                        </a>
                      </h4>
                    </div>
                    <div id="a_{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="q_{{$key}}">
                      <div class="panel-body">
                        {!! $item['a'] !!}
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div> <!-- /.panel-group#faq -->

            </div> <!-- /.content-box-content -->
        </div> <!-- /.content-box -->

        @include('sections.resources')
        
    </div>

</div>

@endsection