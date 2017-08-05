@extends('layouts.default')

@section('content')
    <div class="jumbotron">
        <h1>Welcome</h1>
        <p>This is a simple interface for controlling your local Homestead boxes in one place. You can add sites, monitor and run restart services directly from within this interface.</p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Homestead Boxes</div>
        <div class="panel-body">
            <div class="panel--btns">
                <a href="{{ url('/homestead/add') }}" class="btn btn-success btn-lg">Add Homestead Box</a>
            </div>
            @if($boxes->count() == 0)
                <p class="alert alert-info">You don't have any Homestead boxes added currently.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Box</th>
                            <th>Power</th>
                            <th>Sites</th>
                            <th>Homestead.yaml</th>
                            <th>Vagrant Location</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($boxes as $box)
                        <tr>
                            <td>{!! $box->box_name !!}</td>
                            <td>@if($box->powerStatus()) <span class="label label-primary">On</span> @else <span class="label label-danger">Off</span> @endif</td>
                            <td>{!! $box->sites->count() !!}</td>
                            <td>{!! $box->yaml_location !!}</td>
                            <td>{!! $box->vagrant_file_location !!}</td>
                            <td><a href="{{ url('/homestead/' . $box->id) }}" class="btn btn-default">Manage</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection