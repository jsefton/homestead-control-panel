@extends('layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Add Homestead Box</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ url('/homestead/add') }}" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Box Information</legend>
                    <div class="form-group">
                        <label for="box-name" class="col-lg-3 control-label">Box Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="box_name" id="box-name" placeholder="Box Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ipaddress" class="col-lg-3 control-label">IP Address</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="ip_address" id="ipaddress" value="192.168.10.10" placeholder="IP Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="yaml-location" class="col-lg-3 control-label">Homestead.yaml Location</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="yaml_location" id="yaml-location" placeholder="Homestead.yaml Location">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vagrant-location" class="col-lg-3 control-label">VagrantFile Folder</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="vagrant_file_location" id="vagrant-location" value="~/Homestead" placeholder="VagrantFile Folder Location">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2 text-right">
                            <button type="submit" class="btn btn-primary">Add Box</button>
                            <a href="{{ url('/') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection