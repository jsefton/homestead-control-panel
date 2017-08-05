@extends('layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Add Site to box: {{ $box->box_name }}</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ url('/homestead/' . $box->id . '/sites/add') }}" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Site Information</legend>
                    <div class="form-group">
                        <label for="site_domain" class="col-lg-3 control-label">Site Domain</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="site_domain" id="site_domain" value="" placeholder="Site Domain" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_path" class="col-lg-3 control-label">Site Directory</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="site_path" id="site_path" placeholder="/home/vagrant/Code/" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="database_name" class="col-lg-3 control-label">Database Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="database_name" id="database_name" placeholder="Database Name">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-lg-9 col-lg-offset-3">
                            <p class="alert alert-info">This task requires `sudo` to add the site to your `/etc/hosts`. Please enter your password below:</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_password" class="col-lg-3 control-label">Local User Pasword</label>
                        <div class="col-lg-9">
                            <input type="secret" class="form-control" name="user_password" id="user_password" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2 text-right">
                            <button type="submit" class="btn btn-primary">Add Site</button>
                            <a href="{{ url('/homestead/' . $box->id) }}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection