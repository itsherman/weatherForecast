<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherBitService
{
    protected $apiKey;

    public function __construct()
    {
        // Reads the Weatherbit API key on init required to request the daily forecast
        $this->apiKey = env('WEATHERBIT_API_KEY');
    }

    public function getForecast(string $city): ?array
    {
        // Handles the error if no city is present
        if (! isset($city)) {
            return ['error' => 'No city provided'];
        }

        // Make a get request for WeatherBit's daily forecast
        $request = Http::get('http://api.weatherbit.io/v2.0/forecast/daily', ['city' => $city, 'days' => 5, 'key' => $this->apiKey]);

        // Handles any errors that may arise from fetching the data
        if ($request->failed()) {
            return ['error' => 'Unable to fetch weather data'];
        }

        $data = $request->json();

        // Handles incorrectly formatted data and throws an error
        if (! isset($data['data'])) {
            return ['error' => 'Unexpected response from Weatherbit'];
        }

        $forecast = [];
        foreach ($data['data'] as $day) {
            /** Iterates through each day of the forecast,
             *   parsing the data and assigning it to the
             *   relevant key
             */
            $forecast[] = [
                'date' => $day['datetime'],
                'temp_avg' => $day['temp'],
                'temp_max' => $day['max_temp'],
                'temp_min' => $day['min_temp'],
            ];
        }

        return $forecast;
    }
}
