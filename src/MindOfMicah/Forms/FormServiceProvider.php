<?php
namespace MindOfMicah\Forms;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    protected $defer = true;
    protected function boot()
    {
        $this->package('mindofmicah/forms');
    }
    protected function register()
    {
        $this->app['forms.validator'] = new Commands\FormValidatorCommand;
        $this->commands('forms.validator');
    }
}
