<?php

namespace App\Services\External;

class WeatherService
{
    public function __construct(public string $apikey = "19e5d263")
    {
    }

    public function getWeatherByIP(string $ip)
    {
        return $this->hg_request(['user_id' => $ip], $this->apikey);
    }

    private function hg_request($paramers, $key = null, $endpoint = 'weather')
    {
        $url = 'http://api.hgbrasil.com/' . $endpoint . '/?format=json&';

        if (is_array($paramers)) {
            if (!empty($key)) {
                $paramers = array_merge($paramers, array('key' => $key));
            }

            foreach ($paramers as $key => $value) {
                if (empty($value)) {
                    continue;
                }
                $url .= $key . '=' . urlencode($value) . '&';
            }

            $response = file_get_contents(substr($url, 0, -1));

            return json_decode($response, true);
        } else {
            return false;
        }
    }
}
