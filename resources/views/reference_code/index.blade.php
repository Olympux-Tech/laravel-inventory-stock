@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Reference Link</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Add New Reference Link</a>
        </div>

        <div class="box-body">
            <table id="products-in-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Link</th>
                    <th>Products</th>
                    <th>Agent</th>
                    <th>QTY</th>
                    <th>Point</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>

@endsection