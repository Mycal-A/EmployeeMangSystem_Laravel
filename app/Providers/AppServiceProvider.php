<?php

namespace App\Providers;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Gate;

use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        Gate::define('admin',function(Employee $employee){
            return $employee->email === 'mycal@gmail.com';
        });
    }
}
