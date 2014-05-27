<?php
namespace MindOfMicah\Forms;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    protected $defer = false;
    public function boot()
    {
        $this->package('mindofmicah/forms');
    }

    public function register()
    {
        $this->app['forms.validator'] = $this->app->share(function ($app) {
            $filesystem = $this->app->make('Illuminate\Filesystem\Filesystem');
            return new Commands\FormValidatorCommand($filesystem);
        });

        $this->commands('forms.validator');
    }
}
