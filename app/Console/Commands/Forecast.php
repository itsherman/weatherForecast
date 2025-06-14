<?php

namespace App\Console\Commands;

use App\Services\WeatherBitService;
use Illuminate\Console\Command;

class Forecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast {cities?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets a 5-day forecast for the given cities.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cities = $this->argument('cities');

        // If no city is provided, prompt the user
        if (empty($cities)) {
            $city = $this->ask('Please enter a city: ');
            $cities = [$city];
        }
        // Init service to fetch the data
        $service = new WeatherBitService;

        // Format and label table
        $headers = ['City', 'Day 1', 'Day 2', ' Day 3', 'Day 4', 'Day 5'];
        $rows = [];

        foreach ($cities as $city) {
            // Iterates through each city and collects its forecast
            $forecast = $service->getForecast($city);

            // Converts the raw forecast data into a table friendly format
            $row = [$city];
            foreach ($forecast as $day) {
                $row[] = "Avg: {$day['temp_avg']}, Max: {$day['temp_max']}, Min: {$day['temp_min']}";

            }
            $rows[] = $row;
        }
        // Returns the full table of forecasts
        $this->table($headers, $rows);
    }
}