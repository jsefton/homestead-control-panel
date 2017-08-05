<?php

namespace App\Http\Controllers;

use App\Homestead;
use App\Jobs\ExecuteTask;
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
        Homestead::create($request->all());
        return redirect('/');
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
        //die;

        session()->forget('tail_offset');
        return view('layouts.terminal')->with(['logTitle' => 'Running Task: ' . $task]);
    }
}
