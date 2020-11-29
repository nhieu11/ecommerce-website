<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\carbon;

class DashboardController extends Controller
{
    // public __construct(){

    // }

    public function __invoke()
    {
        $month_now = carbon::now()->format('m');
        $year_now = carbon::now()->format('Y');

        for ($i=1; $i <= $month_now ; $i++) {
            $data['Tháng '.$i] = Order::where('processed',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_now)->sum('total');
        }

         $dh = Order::count();
         
        // session()->put('income','4.000.000');
        // session()->forget('income');

        return view('admin.dashboard',compact('data','dh'));
    }
}
