<?php

namespace App\Providers;

use Validator;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Sets third party service providers that are only needed on local/testing environments
        if ($this->app->environment() !== 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            // Load third party local aliases
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // \DB::listen(function($query) {
        //     \Log::info(
        //         $query->sql,
        //         $query->bindings,
        //         $query->time
        //     );
        // });
        /*
         * Application locale defaults for various components
         *
         * These will be overridden by LocaleMiddleware if the session local is set
         */

        // setLocale for php. Enables ->formatLocalized() with localized values for dates
        setlocale(LC_TIME, config('app.locale_php'));

        // setLocale to use Carbon source locales. Enables diffForHumans() localized
        Carbon::setLocale(config('app.locale'));

        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('locale.languages')[config('app.locale')][2]) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }

        Schema::defaultStringLength(191);

        // Force SSL in production
        // Force SSL in production
        // if($this->app->environment() === 'production') {
        //     if(\Storage::disk('installPath')->exists('INSTALL/site_installed.key') && (int)setting('site.redirect_https')==1){
        //         \URL::forceScheme('https');
        //     }
        // }

        // Set the default template for Pagination to use the included Bootstrap 4 template
        \Illuminate\Pagination\AbstractPaginator::defaultView('pagination::bootstrap-4');
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView('pagination::simple-bootstrap-4');

        // Custom Blade Directives

        /*
         * The block of code inside this directive indicates
         * the project is currently running in read only mode.
         */
        Blade::if('readonly', function () {
            return config('app.read_only');
        });

        /*
         * The block of code inside this directive indicates
         * the chosen language requests RTL support.
         */
        Blade::if('langrtl', function ($session_identifier = 'lang-rtl') {
            return session()->has($session_identifier);
        });

        Validator::extend('payment_can_be_refunded', function($attribute, $value, $parameters, $validator){
            $payment = Payment::where('uuid', $value)->first();
            return $payment->refund_deadline >= Carbon::now('UTC');
        });
        Validator::extend('refund_request_does_not_yet_exist', function($attribute, $value, $parameters, $validator){
            if(!auth()->check()) return false;
            $payment = Payment::where('uuid', $value)->first();
            $course = $payment->course;
            return (bool)auth()->user()->refunds()->where('status', 'open')->where('course_id', $course->id)->count() == 0;
        });
        
        Validator::extend('youtube', function ($attribute, $value, $parameters, $validator) {
            return (bool) preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/',$value);
        });
    }
}
