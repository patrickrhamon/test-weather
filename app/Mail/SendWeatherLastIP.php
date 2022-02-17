<?php

namespace App\Mail;

use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWeatherLastIP extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private int $user_id,
        protected UserService $user_service
    ) {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user_service->findById($this->user_id);
        
        return $this->view('mail.weather', ['user' => $user, 'weather' => $weather]);
    }
}
