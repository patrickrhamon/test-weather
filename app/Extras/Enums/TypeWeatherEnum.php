<?php

namespace App\Extras\Enums;

class TypeWeatherEnum
{
    const HTTP = 1;
    const COMMAND = 2;

    static function list(): array
    {
        return [
            TypeWeatherEnum::HTTP => "Request by HTTP.",
            TypeWeatherEnum::COMMAND => "Background Commands.",
        ];
    }
}
