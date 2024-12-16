<?php

namespace StancerLaravel;

use Illuminate\Support\ServiceProvider;
use Stancer\Config;

class StancerServiceProvider extends ServiceProvider
{
    public function register()
    {
        Config::init([
            'api_key' => config('stancer.api_key'), // your API key in file config/stancer.php
            'endpoint' => config('stancer.endpoint'), // optionnal
        ]);
    }

    public function boot()
    {
        //
    }
}