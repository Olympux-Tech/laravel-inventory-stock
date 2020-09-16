@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

    <form method="POST" action="{{ route('admin.create.reference.link') }}">
        @csrf
        <div class="form-group">
            <label >Name</label>
            <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
            <span class="help-block with-errors"></span>
        </div>
        <div class="form-group">
            <label >Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <span class="help-block with-errors"></span>
        </div>
        <div class="form-group">
            <label >Phone</label>
            <input type="text" class="form-control" id="telepon" name="telepon">
            <span class="help-block with-errors"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection