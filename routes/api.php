<?php

use Illuminate\Support\Facades\Route;
use App\Services\WeatherBitService;

Route::get('/forecast/{city}', function ($city) {
    $service = new WeatherBitService();
    return $service->getForecast($city);
});

Route::get('/test', fn () => 'test working');