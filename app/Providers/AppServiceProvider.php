<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

   public function __construct()
   {
      if(config('app.env') == 'production') {
         URL::forceScheme('https');
      }
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

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot()
   {
      // if ($this->app->environment('production')) {
      //    URL::forceScheme('https');
      // }
   }
}
