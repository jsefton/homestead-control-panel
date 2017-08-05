<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function view($log)
    {
        $handle = fopen(storage_path() . '/logs/artisan-tasks.log', 'r');
        if (session('tail_offset')) {
            //echo session()->get('tail_offset') . "<br />";
            $data = stream_get_contents($handle, -1, session()->get('tail_offset'));
            echo nl2br($data);
            fseek($handle, 0, SEEK_END);
            session(['tail_offset' => ftell($handle)]);
        } else {
            $data = stream_get_contents($handle, -1, 0);
            echo nl2br($data);
            fseek($handle, 0, SEEK_END);
            session(['tail_offset' => ftell($handle)]);

        }
    }

    public function tail($log)
    {
        session()->forget('tail_offset');
        return view('layouts.terminal')->with(['logTitle' => 'Log Viewer']);
    }
}
