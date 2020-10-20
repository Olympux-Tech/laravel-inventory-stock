@extends('layouts.master')

@section('top')

@endsection

@section('content')

    <div class="container col-lg-8">
        <input class="usernameInput" type="hidden" value="admin" maxlength="14" />
      <div class="panel panel-default">
        <div class="panel-heading">Customer chat</div>
        <div class="panel-body" style="min-height:165px">
          <div class="chatArea">
            <ul class="messages list-group col-lg-8"></ul>
          </div>
        </div>
        <div class="panel-footer text-center">
          <input class="inputMessage form-control" placeholder="Type here..." />
        <input class="secretToken" type="hidden" value="#1234" maxlength="14" />
        </div>
      </div>
    </div>
    <div style="height:500px" class="container col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>Connected customers</h2>
        </div>
        <div style="height:100%" class="panel-body">
          <ul class="user-lists list-group">
          </ul>
        </div>
      </div>
    </div>    
@endsection
@section('bot')
  <script src="{{ URL::asset('js/app.js') }}"></script>
@endsection
