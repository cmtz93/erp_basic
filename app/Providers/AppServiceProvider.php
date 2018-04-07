<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerResponseMacros();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    protected function registerResponseMacros()
    {
        $response = app(ResponseFactory::class);

        $response->macro('success', function ($message, $data , $status = 200) use ($response) {
            return $response->json([
                'errors' => false,
                'message' => $message,
                'data' => $data
            ], $status);
        });

        $response->macro('error', function ($message, $status = 422, $additional_info = []) use ($response) {
            return $response->json([
                'message' => $status . ' error',
                'errors' => [
                    'message' => $message,
                    'info' => $additional_info,
                ],
                'status_code' => $status
                ], $status);
        });
    }
}
