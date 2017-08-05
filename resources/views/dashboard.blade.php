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
                            <th>Homestead.yaml</th>
                            <th>Vagrant Location</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($boxes as $box)
                        <tr>
                            <td>{!! $box->box_name !!}</td>
                            <td>{!! $box->yaml_location !!}</td>
                            <td>{!! $box->vagrant_file_location !!}</td>
                            <td><a href="{{ url('/homestead/' . $box->id) }}" class="btn btn-primary">Manage</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection