@extends('layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $box->box_name }} box</div>
        <div class="panel-body">
            <div class="jumbotron">
                <h1>Site: {!! $site->site_domain !!}</h1>
                @if($box->powerStatus())
                    <p class="alert alert-success">Folder: {{ $site->site_path }}</p>
                    <a href="http://{{ $site->site_domain }}" class="btn btn-primary btn-lg" target="_blank">Open Site</a>
                    <a href="{{ url('/terminal/site-log/' . $site->id) }}" class="terminal-task btn btn-info btn-lg">View Error Logs</a>
                    <a href="{{ url('/homestead/' . $box->id) }}" class="btn btn-default btn-lg">Back</a>
                @else
                    <div class="alert alert-warning">
                        <div class="row">
                            <div class="col-sm-6">Power: Off<br />
                                IP Address: {{ $box->ip_address }}<br /></div>
                            <div class="col-sm-6">CPUs: {{ $box->cpus }}<br />
                                Memory: {{ $box->memory }}MB</div>
                        </div>
                    </div>
                    <a href="{{ url('/homestead/' . $box->id . '/task/power') }}" class="terminal-task btn btn-primary btn-lg">Power On Box</a>
                @endif
            </div>

            <div id="terminal" class="">
                <div class="page-header">
                    <h2>Logs</h2>
                    <div class="btn btn-default btn--close">@if(request()->get('log')) Hide @else Show @endif</div>
                </div>
                <iframe src="" frameborder="0"></iframe>
                <p class="alert alert-info">There are no logs to show yet.</p>
            </div>
        </div>
    </div>
@endsection