@extends('layouts.master')


@section('top')

@endsection

@section('content')

  <div class="container">
    <div class="col-lg-8">
      <div class="form">
        <h3 class="title">Hello welcome admin!</h3>
        <input class="usernameInput" type="hidden" value="admin" maxlength="14" />
      </div>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading">Customer chat</div>
        <div class="panel-body" style="min-height:165px">
          <div class="chatArea">
            <ul class="messages"></ul>
          </div>
        </div>
        <div class="panel-footer text-center">
          <input class="inputMessage form-control" placeholder="Type here..." />
        <input class="secretToken" type="hidden" value="#1234" maxlength="14" />
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <ul style="height:500px" class="container">
        <div class="panel-heading">
          <h2>Connected customers</h2>
        </div>
        <div style="height:100%" class="panel-body">
          <ul class="userLists"></ul>
        </div>
      </ul>
    </div>    
  </div>
@endsection
@section('bot')
  <script src="{{ URL::asset('js/app.js') }}"></script>
@endsection
