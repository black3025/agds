<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuDataAdmin= file_get_contents(base_path('resources/menu/verticalMenuAdmin.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    $verticalMenuDataAdmin = json_decode($verticalMenuDataAdmin);

    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData]);
    \View::share('AdminMenuData', [$verticalMenuDataAdmin]);
  }
}
