@extends('layouts.app')

<head>
  <meta charset="UTF-8">
  <title>Support Chat for Customer</title>
  <!-- <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"> -->
</head>

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-6">
          <img style="width:100%" src="{{ URL::asset('img/customer-chat-bg.png') }}">
      </div>
      <div style="padding:5px;background-color:white" class="panel panel-info col-lg-6 pull-right">
        <div class="form">
          <h3 class="title">Welcome to Support Chat</h3>
          <input class="usernameInput" type="hidden" value="customer" maxlength="14" />
        </div>
        <br>
        <div class="panel-heading">
          <p>Say 'Hi' to start chatting</p>
        </div>
        <div class="panel-body" style="min-height:350px">
          <div class="chatArea">
            <ul class="messages list-group col-lg-8"></ul>
          </div>
        </div>
        <div class="panel-footer text-center">
          <input class="inputMessage form-control" placeholder="Type here..." />
          <input class="userId" type="hidden" value="2"/>
          <input class="friendId" type="hidden" value="mPMxDa0WehumuIzrAAAF"/>
          <input class="secretToken" type="hidden" value="#" maxlength="14" />
        </div>
      </div>
    </div>
  </div>

@endsection

@section('bot')

    <script src="{{ URL::asset('js/app.js') }}"></script>
    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>--}}

    <script type="text/javascript">
        function onSubmit() {
            alert("The form was submitted");
        }
    </script>

@endsection
