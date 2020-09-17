@extends('layouts.app')

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="" id="modal-form" tabindex="1" role="dialog" data-backdrop="static" onsubmit="onSubmit()">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.fetch.reference.link', $found->reference_code) }}">
                @csrf
                <div class="form-group col-md-12">
                    <h2>Please fill out the form to continue contacting us.</h2>
                </div>
                <div class="form-group col-md-12">
                    <label >Name</label>
                    <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group col-md-12">
                    <label >Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group col-md-12">
                    <label >Phone</label>
                    <input type="text" class="form-control" id="telepon" name="telepon">
                    <span class="help-block with-errors"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->    

@endsection

@section('bot')

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