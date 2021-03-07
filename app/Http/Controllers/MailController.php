<?php

namespace App\Http\Controllers;

use App\Mail\ContactsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function contacts(Request $request)
    {
//        dd($request);
        $request->validate([
           'email' => 'email|required'
        ]);
        Mail::to('televonvea@gmail.com')->send( new ContactsMail($request) );
        return back();
    }
}
