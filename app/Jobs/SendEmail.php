<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_email;
    public $tries=3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_email)
    {
        $this->user_email =$user_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::send('register_message',['name'=>'www.Chat.com'],function ($message){
            $mail_name = env('MAIL_USERNAME');

            $message->to($this->user_email)->subject('Chat');

            $message->from($mail_name);
        });
    }
}
