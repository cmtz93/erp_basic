<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
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

        $response->macro('success', function ($message = null, $data = null , $status = 200, $meta_data = null) use ($response) {
            if ( is_null($message) ) $status = 204;
            return $response->json([
                'message' => $message,
                'data'    => $data,
                'meta_data' => $meta_data,
                'errors'  => false,
            ], $status);
        });

        $response->macro('errors', function ($message = null, $errors = [], $status = 404, $meta_data = null) use ($response) {
            if ( is_null($message) ) $message = __('message.errors');
            return $response->json([
                'message' => $message,
                'errors'  => $errors,
                'meta_data' => $meta_data,
                ], $status);
        });
    }
}
