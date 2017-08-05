@extends('layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $box->box_name }} box</div>
        <div class="panel-body">
            <div class="jumbotron">
                <h1>Box: {!! $box->box_name !!}</h1>
                @if($box->powerStatus())
                    <div class="alert alert-success">
                        <div class="row">
                            <div class="col-sm-6">Power: On<br />
                                IP Address: {{ $box->ip_address }}<br /></div>
                            <div class="col-sm-6">CPUs: {{ $box->cpus }}<br />
                                Memory: {{ $box->memory }}MB</div>
                        </div>
                    </div>
                    <a href="{{ url('/homestead/' . $box->id . '/task/sites-fetch') }}" class="terminal-task btn btn-default btn-lg">Refresh Site List</a>
                    <a href="{{ url('/homestead/' . $box->id . '/task/provision') }}" class="terminal-task btn btn-info btn-lg">Provision Box</a>
                    <a href="{{ url('/homestead/' . $box->id . '/task/shutdown') }}" class="terminal-task btn btn-danger btn-lg">Shutdown Box</a>
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

            <div id="terminal" @if(request()->get('log')) class="-load-show -active" @endif>
                <div class="page-header">
                    <h2>Logs</h2>
                    <div class="btn btn-default btn--close">@if(request()->get('log')) Hide @else Show @endif</div>
                </div>

                <iframe src="{{ url('/terminal/tail-view/artisan-tasks.log') }}" frameborder="0"></iframe>
                <p class="alert alert-info">There are no logs to show yet.</p>
            </div>


            <div class="page-header">
                <h2>Sites ({{ $box->sites->count() }})</h2>
            </div>
            @if($box->powerStatus())
            <div class="panel--btns">
                <a href="{{ url('/homestead/' . $box->id . '/sites/add') }}" class="btn btn-success">Add New Site</a>
            </div>
            @endif
            @if($box->sites->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Domain</th>
                        <th>Folder</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($box->sites as $site)
                            <tr>
                                <td>{!! $site->site_domain !!}</td>
                                <td>{!! $site->site_path !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">No sites have been found for this box, please try refresh site list</p>
            @endif
        </div>
    </div>
@endsection