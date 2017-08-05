<?php

namespace App\Http\Controllers;

use App\Homestead;
use App\Jobs\ExecuteTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomesteadController extends Controller
{
    public function addBox()
    {
        return view('homestead.add');
    }

    public function store(Request $request)
    {
        $data = Homestead::create($request->all());

        // After creation run import of sites
        Artisan::call('homestead:sites-fetch', ['--box' => $data->id]);

        return redirect('/homestead/' . $data->id);
    }

    public function view($id)
    {
        $homestead = Homestead::find($id);
        return view('homestead.view')->with(['box' => $homestead]);
    }

    public function task($id, $task)
    {
        $command = 'homestead:' . $task . " --box=" . $id;
        dispatch(new ExecuteTask($command));
        session()->forget('tail_offset');
        return view('layouts.terminal')->with(['logTitle' => 'Running Task: ' . $task]);
    }

    public function addSite($id)
    {
        $homestead = Homestead::find($id);
        return view('homestead.sites.add')->with(['box' => $homestead]);
    }


    public function storeSite(Request $request, $id)
    {
        $command = 'homestead:add-site --box=' . $id . ' --domain=' . $request->get('site_domain') . ' --folder=' . $request->get('site_path');
        if($request->get('database_name')) {
            $command .= ' --db=' . $request->get('database_name');
        }

        $job = (new ExecuteTask($command))->delay(Carbon::now()->addSeconds(3));
        dispatch($job);

        $command = 'homestead:provision --box=' . $id;
        $job = (new ExecuteTask($command))->delay(Carbon::now()->addSeconds(7));;
        dispatch($job);

        return redirect('/homestead/' . $id . '?log=show');
    }
}
