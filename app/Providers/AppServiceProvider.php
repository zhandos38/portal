<?php

namespace App\Providers;

use App\Envelope;
use App\EnvelopeStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('superadmin', function (){
            return Auth::user()->role_id == 1 ? true : false;
        });
        Blade::if('administrator', function (){
            return Auth::user()->role_id == 1 or Auth::user()->role_id == 2 ? true : false;
        });
        Blade::if('moderator', function (){
            return Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 ? true : false;
        });
        Blade::if('teacher', function (){
            return Auth::user()->role_id == 1 || Auth::user()->role_id == 4 ? true : false;
        });
        Blade::if('onlyTeacher', function (){
            return Auth::user()->role_id == 4 ? true : false;
        });
        Blade::if('student', function (){
            return Auth::user()->role_id == 5 ? true : false;
        });

        view()->composer('teachers._sidebar', function($view){
            $view->with('incomings', EnvelopeStudent::where(['teacher_id' => Auth::id(), 'status' => 0])->get());
        });
        view()->composer('teachers._sidebar', function($view){
            $view->with('readEnvelopes', EnvelopeStudent::where(['teacher_id' => Auth::id(), 'status' => 1])->get());
        });
        view()->composer('teachers._sidebar', function($view){
            $view->with('sendEnvelopes', Envelope::where('teacher_id', Auth::id())->pluck('id', 'student_id')->all());
        });

        view()->composer('students._sidebar', function($view){
            $view->with('incomings', Envelope::where(['student_id' => Auth::id(), 'status' => 0])->get());
        });
        view()->composer('students._sidebar', function($view){
            $view->with('readEnvelopes', Envelope::where(['student_id' => Auth::id(), 'status' => 1])->get());
        });
        view()->composer('students._sidebar', function($view){
            $view->with('sendEnvelopes', EnvelopeStudent::where('student_id', Auth::id())->pluck('id', 'teacher_id')->all());
        });
    }
}
