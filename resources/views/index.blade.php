@extends('layouts.main')

@section('content')

<div class="home with-jumbotron content-box with-header">
  <div class="jumbotron">
    <h1>Lights. Music. Christmas.</h1>
    <p class="lead">Light Up Burton is an annual Christmas light show brought to you by the Johnson family in Burton, Michigan.</p>
  </div>
  <div class="content-box-content">

    <div class="row marketing">
      <div class="col-lg-6">
        <h4>More Than Just Lights</h4>
        <p>Our lights are, well, more than just lights. Each light bulb is synchronzied to the music to create a spectacular light show.</p>

      </div>

      <div class="col-lg-6">
        <h4>2,000 Lights &mdash; 5 songs</h4>
        <p>We've got around 2,000 smart pixel lights and standard lights synchronized to five great Christmas songs.</p>

      </div>
    </div>
    <div class="row marketing">
      <div class="col-lg-12">

        <h4>Come enjoy the show!</h4>
        <p style="font-size:16px;">See the <a href="/info">Info</a> page for our location including Google Maps directions and more information.</p>
      </div>
    </div>

    <div class="social">
      <a href="http://facebook.com/LightUpBurton">
      <img src="/img/social-media/like-fb.png" class="fb" />
      </a>
      &nbsp;
      &nbsp;
      <a href="http://twitter.com/LightUpBurton">
      <img src="/img/social-media/twitter_follow.png" />
      </a>

    </div>

  </div>
</div>

@endsection