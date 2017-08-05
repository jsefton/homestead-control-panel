@extends('layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $box->box_name }} box</div>
        <div class="panel-body">
            <div class="jumbotron">
                <h1>Box: {!! $box->box_name !!}</h1>
                @if($box->powerStatus())
                    <p class="alert alert-success">IP Address: {{ $box->ip_address }} - Power: On</p>
                    <a href="{{ url('/homestead/' . $box->id . '/task/provision') }}" class="btn btn-info btn-lg">Provision Box</a>
                    <a href="{{ url('/homestead/' . $box->id . '/task/shutdown') }}" class="btn btn-danger btn-lg">Shutdown Box</a>
                @else
                    <p class="alert alert-danger">IP Address: {{ $box->ip_address }} - Power: Off</p>
                    <a href="{{ url('/homestead/' . $box->id . '/task/power') }}" class="btn btn-primary btn-lg">Power On Box</a>
                @endif
            </div>
        </div>
    </div>
@endsection