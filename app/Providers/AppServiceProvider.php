<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Lesson;

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
        view()->composer('components/sidebar',function($view){
            $lesson = Lesson::all()->where('delete',false)->where('substitute_instructor', session()->get('user')['id'])->where('approved', 0)->count();
            $view->with(['lessonCount'=> $lesson]);
        });
    }
}
