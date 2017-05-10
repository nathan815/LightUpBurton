<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <div class="navbar-header navbar-left">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img class="img-responsive logo" src="/img/logos/logo-navbar.png" /></a>
    </div>

    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li{!! classActivePath('/') !!}><a href="/">Home</a></li>
        <li{!! classActivePath('info') !!}><a href="/info">Info</a></li>
        <li{!! classActiveSegment(1, 'gallery') !!}><a href="/gallery">Gallery</a></li>
        <li{!! classActiveSegment(1, 'blog') !!}><a href="/blog">Blog</a></li>
        <li{!! classActivePath('contact') !!}><a href="/contact">Contact</a></li>
      </ul>
    </div>

  </div><!--/.container -->
</nav>