<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use NumberFormatter;
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
        
        Blade::directive('formatMoney', function ($expression) {
            //$fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
            return "<?php echo '$'.number_format($expression, 2); ?>";
        });
    }
}
