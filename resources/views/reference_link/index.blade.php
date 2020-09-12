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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewReferenceLink">
                Add New Reference Link
            </button>
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

    <div class="modal fade" id="createNewReferenceLink" tabindex="-1" aria-labelledby="createNewReferenceLinkLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewReferenceLinkLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Agent</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                @foreach($agents as $a)
                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Claim Limit</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Point Worth</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection