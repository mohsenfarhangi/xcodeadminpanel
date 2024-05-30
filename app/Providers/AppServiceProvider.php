<?php

namespace App\Providers;

use App\Http\Core\Adapters\Bootstrap;
use App\Http\Core\Adapters\Theme;
use App\Models\Drivers;
use App\Models\ProductOrders;
use App\Models\Users;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Builder::useVite();

        View::composer('*', function ($view) {
            $records = [];
            $settings = config('theme.general.theme');
            foreach ($settings as $key => $record) {
                $records[$key] = $record;
            }
            $view->with('settings', $records);
        });

        $theme = new Theme;

        // Share theme adapter class
        View::share('theme', $theme);

        $theme->initConfig();

        Bootstrap::run();


        Relation::enforceMorphMap([
            'driver'        => Drivers::class,
            'user'          => Users::class,
            'admin'         => Admins::class,
            'product_order' => ProductOrders::class,
            'recycle_item'  => RecycledItems::class,
        ]);
    }
}
