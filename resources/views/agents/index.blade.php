@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Agents</h3>
        </div>

        <div class="box-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewAgent">
                Register Agent
            </button>
        </div>

        <div class="box-body">
            <table id="products-in-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Point</th>
                    <th>Claimed Point</th>
{{--                    <th>QTY</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($agents as $a)
                    <tr>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->total_point }}</td>
                        <td>{{ $a->point_claimed }}</td>
{{--                        <td>{{ $a->point }}</td>--}}
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateAgentPoint">
                                Deduct Points
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal fade" id="createNewAgent" tabindex="-1" aria-labelledby="createNewReferenceLinkLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewReferenceLinkLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>

    <div class="modal fade" id="updateAgentPoint" tabindex="-1" aria-labelledby="deductAgentPoint" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deductAgentPoint">Deduct Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="form-group row">
                        <label for="total_point" class="col-md-4 col-form-label text-md-right">{{ __('Total_point') }}</label>
                        <label for="point_deduct" class="col-md-4 col-form-label text-md-right">Enter number of points to deduct</label>

                        <div class="col-md-6">
                            <input id="point_deduct" type="number" class="form-control{{ $errors->has('point_deduct') ? ' is-invalid' : '' }}" name="point_deduct" value="{{ old('point_deduct') }}" required autofocus>

                            @if ($errors->has('point_deduct'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('point_deduct') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>        
    </div>

@endsection