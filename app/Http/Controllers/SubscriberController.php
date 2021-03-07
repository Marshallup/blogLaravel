<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    function store(Request $request)
    {
        $request->validate([
           'email' => 'required|email|unique:subscribers'
        ]);
        $data = $request->all();
        Subscriber::create($data);

        return back();
    }

    function run()
    {
        $subscribers = Subscriber::all();
//        dd($subscribers);
    }
}
