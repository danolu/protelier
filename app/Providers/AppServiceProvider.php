<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use View;
use Auth;
use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\User;

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
        Schema::defaultStringLength(125);
        $data['hotel'] = Hotel::first();  
        $data['roomtypes'] = RoomType::where('status', 1)->get();
        $data['k'] = 0;
        view::share($data);
        View::composer('*', function($view){
            if (Auth::check()){
                $user = Auth::user();
                $view->with('user', $user );
            }    
        });
    }
}
