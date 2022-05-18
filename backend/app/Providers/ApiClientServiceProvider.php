<?php

namespace App\Providers;

use App\Services\AntMediaClientService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ApiClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(AntMediaClientService::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client([
                    'base_uri' => env('ANT_MEDIA_BASE_URI'),
                    'headers' => [
                        'Accept' => 'application/json; charset=utf-8',
                        'Content-Type' => 'application/json'
                    ]
                ]);
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
