@extends('layouts.master')


@section('top')

@endsection

@section('content')

  <div class="container">
    <div class="form">
      <h3 class="title">Hello welcome admin!</h3>
      <input class="usernameInput" type="hidden" value="admin" maxlength="14" />
    </div>
    <br>
    <div class="panel panel-default">
      <div class="panel-heading">Customer chat</div>
      <div class="panel-body">
        <div class="chatArea">
          <ul class="messages"></ul>
        </div>
      </div>
      <div class="panel-footer text-center">
        <input class="inputMessage form-control" placeholder="Type here..." />
      </div>
    </div>
  </div>
@endsection
@section('bot')
  <script src="{{ URL::asset('js/app.js') }}"></script>
  @endsection
