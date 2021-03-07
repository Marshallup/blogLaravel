<?php

namespace App\Listeners;

use App\Events\onArticleCreate;
use App\Jobs\BlogPostAfterCreate;
use App\Mail\NewsLetterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSubscriptions
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  onArticleCreate  $event
     * @return void
     */
    public function handle(onArticleCreate $event)
    {
//        dd($event);
        foreach($event->data as $data)
        {
//            dump($data->email);
//            Mail::to($data->email)->send( new NewsLetterMail() );
            BlogPostAfterCreate::dispatch($data->email);
        }

//        dump($event->data);
//        dump('asdasd');
//        Mail::to($event->data)->queue( new NewsLetterMail() );
//        dd(['asdasd']);
    }
}
