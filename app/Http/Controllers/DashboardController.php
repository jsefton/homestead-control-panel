<?php

namespace App\Http\Controllers;

use App\Homestead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $boxes = Homestead::all();
        return view('dashboard')->with(['boxes' => $boxes]);
    }
}
