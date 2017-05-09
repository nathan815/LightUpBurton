@extends('layouts.main')

@section('title','Contact Us')
@section('content')
<div class="content-box with-header">
    <div class="content-box-header">
        <h3>Contact Us</h3>
    </div>
    <div class="content-box-content">
        <h4 class="text-center">Have any questions or comments? Contact us via the form below.</h4>

        <hr />

        <form method="post" id="contact">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Santa Claus" required autofocus>
          </div>

          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="santa@northpole.com" required>
          </div>

          <div class="form-group">
            <label for="msg">Message</label>
            <textarea rows="5" class="form-control" id="msg" name="msg" placeholder="Enter a message..." required maxlength="500"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Send <span class="glyphicon glyphicon-arrow-right"></span></button>

        </form>

    </div>
</div>
@endsection