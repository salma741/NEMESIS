<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
          // Load configurations from the database
          $configurations = Configuration::all();

          // Share the configurations globally
          view()->share('configurations', $configurations);
  
          // Optionally, share it via the app container
          app()->instance('configurations', $configurations);
    }
}
