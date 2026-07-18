<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;
use App\Models\Hospital;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        try {
            if (Schema::hasTable('hospitals')) {
                $setting = Hospital::first();
                view()->share('setting', $setting);
            }
        } catch (\Exception $e) {
            view()->share('setting', null);
        }

        Blade::directive('permission', function ($permission) {
            return "<?php if ( Auth::check() && in_array($permission, Auth::user()->role->permissions->pluck('name')->toArray())): ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Http/helpers.php');
    }
}
