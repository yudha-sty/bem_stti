<?php

namespace App\Providers;

use App\Models\FooterSetting;
use App\Models\GlobalSetting;
use App\Models\RegistrationSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts/userLayouts', function ($view) {
            $registrationSetting = RegistrationSetting::first();
            $globalSetting = GlobalSetting::first();
            $footerSetting = FooterSetting::first();

            $view->with('registrationSetting', $registrationSetting)
                ->with('globalSetting', $globalSetting)
                ->with('footerSetting', $footerSetting);
        });

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
