<?php

namespace AhmetSerefoglu\RecursingLichterman;

use Illuminate\Support\ServiceProvider;

class BookListPackageServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    // 
    $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    $this->loadMigrationsFrom(__DIR__ . 'database/migrations');
  }
}
