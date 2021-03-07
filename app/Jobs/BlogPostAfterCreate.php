<?php

namespace App\Jobs;

use App\Mail\NewsLetterMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BlogPostAfterCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscriber;

    /**
     * Create a new job instance.
     *
     * @param $subscriber
     */
    public function __construct($subscriber) //($email)
    {
//        var_dump($email);
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $subscribers = Subscriber::get('email');
//        $email = new NewsLetterMail();
//        foreach($subscribers as $subscriber)
//        {
//            Mail::to($subscriber)->queue($email);
//        }





//        $subscribers = Subscriber::get('email');
//
//        foreach ($subscribers as $subscriber) {
//            Mail::to($subscriber->email)->send(new NewsLetterMail());
//        }




        Mail::to($this->subscriber)->send(new NewsLetterMail());


//        var_dump(Subscriber::get('email'));
//        var_dump($this->email);


//        Mail::to($this->email)->queue(new NewsLetterMail());


//        $subscribers = $this->email;
//        foreach ($subscribers as $subscriber) {
//            Mail::to($subscriber->email)->queue(new NewsLetterMail());
//        }
//
//        Mail::to('televonvea@gmail.com')->send(new NewsLetterMail());
    }
}
