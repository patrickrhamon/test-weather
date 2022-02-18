<?php

namespace App\Mail;

use App\Events\SaveLogEvent;
use App\Extras\Enums\TypeWeatherEnum;
use App\Services\External\WeatherService;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWeatherLastIP extends Mailable
{
    use Queueable, SerializesModels;

    public $user_id;
    public $type;
    public $user_service;
    public $weather_service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        int $user_id,
        int $type = TypeWeatherEnum::COMMAND
    ) {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->user_service = new UserService();
        $this->weather_service = new WeatherService();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user_service->findById($this->user_id);
        $weather = $this->weather_service->getWeatherByIP($user->last_ip);
        event(new SaveLogEvent($weather, $this->type, $user));
        
        return $this->view('mail.weather', ['user' => $user, 'weather' => $weather]);
    }
}
