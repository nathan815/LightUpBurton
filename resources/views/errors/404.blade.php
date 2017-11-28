@extends('layouts.main')

@section('title','404 Not Found')

@section('content')

<script data-cfasync="false">
  (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
    (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
    m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-nvvOpn.js";
    b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
  </script>

  <div class="content-box with-jumbotron with-header text-center">
    <div class="jumbotron">
      <h2>Oops! Something must be unplugged.</h2>
      <p>The page you were looking for could not be found.</p>
    </div>


    <h4>Try clicking on one of the navigation links above.</h4>
    <br />
    <div class="row">
      <div class="col-md-8 col-md-offset-2"><iframe width="560" height="315" src="https://www.youtube.com/embed/nsaxNehMibg" frameborder="0" allowfullscreen></iframe></div>
    </div>
  </div>

  @endsection