<?php
    namespace Bkremenovic\Licenceplate;

    use Illuminate\Support\ServiceProvider;

    class LicenceplateServiceProvider extends ServiceProvider {
        public function register() {
            $this->app->bind('licenceplate', 'Bkremenovic\Licenceplate\Licenceplate');

            $this->mergeConfigFrom(__DIR__.'/../config/licenceplate.php', 'licenceplate');
            $this->publishes([__DIR__ . '/../config/licenceplate.php' => config_path('licenceplate.php')], 'config');
        }
    }