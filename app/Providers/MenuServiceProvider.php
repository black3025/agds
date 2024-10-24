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
    $verticalMenuDataAdminJson= file_get_contents(base_path('resources/menu/verticalMenuAdmin.json'));
    $verticalMenuDataTeacherJson= file_get_contents(base_path('resources/menu/verticalMenuTeacher.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    $verticalMenuDataAdmin = json_decode($verticalMenuDataAdminJson);
    $verticalMenuDataTeacher = json_decode($verticalMenuDataTeacherJson);

    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData]);
    \View::share('AdminMenuData', [$verticalMenuDataAdmin]);
    \View::share('TeacherMenuData', [$verticalMenuDataTeacher]);
  }
}
