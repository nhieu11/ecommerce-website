<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public __construct(){

    // }

    public function __invoke()
    {
        // session()->put('income','4.000.000');
        session()->forget('income');

        return view('admin.dashboard');
    }
}
