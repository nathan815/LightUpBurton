<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="Light Up Burton is an upcoming computerized Christmas light display in Burton, MI brought to you by the Johnson family.">
  <meta name="author" content="Nathan Johnson">

  <title>Light Up Burton | @yield('title', 'Johnson Family Christmas Light Show')</title>

  <link href="/css/app.css" rel="stylesheet" />

</head>
<body>

    @include('sections.navbar')
    @include('sections.infobar')

  <div class="container">
    <div id="content">
      @yield('content')
    </div>

    @include('sections.footer')

  </div> <!-- /container -->


  <script src="/js/app.js"></script>
  @yield('scripts')

</body>
</html>