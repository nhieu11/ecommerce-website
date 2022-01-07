<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('client.user.index');
    }

    public function order()
    {
        return view('client.user.orders');
    }

    public function tracking()
    {
        return view('client.user.tracking');
    }
}