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
                    <th>Reference code</th>
                    <th>Agent</th>
                    <th>QTY</th>
                    <th>Point</th>
                </tr>
                </thead>
                <tbody>
                @foreach($referenceLinks as $rl)
                    <tr>
                        <td><a href="{{$rl->reference_link}}">{{$rl->reference_link}}</a></td>
                        <td>{{ $rl->reference_code }}</td>
                        <td>{{ $rl->user->name }}</td>
                        <td>{{ $rl->max_claim }}</td>
                        <td>{{ $rl->point }}</td>
                    </tr>
                @endforeach
                </tbody>
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
                    <form method="POST" action="{{ route('admin.create.reference.link') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Agent</label>
                            <select class="form-control" name="agent_id" id="exampleFormControlSelect1">
                                @foreach($agents as $a)
                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Claim Limit</label>
                            <input type="number" name="max_claim" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Point Worth</label>
                            <input type="number" name="point" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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