<?php

namespace App\Http\Controllers\Api;

use App\Events\SaveLogEvent;
use App\Extras\Enums\TypeWeatherEnum;
use App\Services\External\WeatherService;
use App\Services\UserService;

class WeatherController extends BaseController
{
    public function __construct(
        protected WeatherService $weatherService,
        protected UserService $userService
    ) {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ip = request()->ip();
        $weather = $this->weatherService->getWeatherByIP($ip);

        $user = auth()->user();
        if ($user) {
            $data = ['last_ip' => $ip];
            $this->userService->update($user->id, $data);
        }

        event(new SaveLogEvent($weather, TypeWeatherEnum::HTTP, $user));

        return $this->sendResponse($weather, 'Weather');
    }
}
