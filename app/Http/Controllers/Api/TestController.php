<?php

namespace App\Http\Controllers\Api;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\WelcomeMail;

class TestController extends Controller
{
    public function welcome()
    {
        Mail::to('hieubuimedia@gmail.com')->send(new WelcomeMail);
        
        return response()->json([
            'message' => 'goodevening'
        ], );
    }

    public function goodbye()
    {
        $product = Product::first();
        return response()->json([
            'errorCode' => 99,
            'message' => 'bye bye',
            'product' => $product,
            'data' => [
                'product' => $product
            ]
        ], 400);
    }
}
