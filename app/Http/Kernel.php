<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $cruises = Cruise::active();
            foreach($cruises as $cruise)
            {
                if(DateTime::createFromFormat('Y-m-d', $cruise->depart_date) <= new DateTime())
                {
                    $cruise->status = 3;
                    $cruise->save();
                }
            }
            $promotions = App\Promotion::active();
            foreach($promotions as $promotion)
            {
                if(DateTime::createFromFormat('Y-m-d', $promotion->end_date) >= new DateTime())
                $promotion->status = 1;
                $promotion->save();
            }
        })->daily()->sendOutputTo('/cron');
    }
}
