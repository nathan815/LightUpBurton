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
        <p>Our lights are more than just lights. Each light bulb is synchronzied to the music to create a spectacular light show.</p>

      </div>

      <div class="col-lg-6">
        <h4>Come enjoy the show</h4>
        <p>See the <a href="/info">Info</a> page for our location including Google Maps directions and more information.</p>

      </div>
    </div>

    <div class="row marketing">
      <div class="col-lg-12">

        <div class="home-countdown">

          <div class="number">
            <span id="hours">*</span>
            <small>hours</small>
          </div>
          <div class="number">
            <span id="minutes">*</span>
            <small>minutes</small>
          </div>
          <div class="number">
            <span id="seconds">*</span>
            <small>seconds</small>
          </div>
          <div class="clearfix"></div>

          until next show

        </div>

      </div>
    </div>

  </div>
</div>

@endsection