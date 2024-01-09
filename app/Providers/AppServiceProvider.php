<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\card;
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
    View::composer('*', function ($view) {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the user and items_data
            $user = Auth::user();
            $items_data = card::where('user_id', $user->id)->get();

            // Pass the data to the view
            $view->with('user', $user)
                  ->with('items_data_count', count($items_data));
        } else {
            // User is not logged in, pass null or default values
            $view->with('user', null)
                  ->with('items_data_count', 0);
        }
    });
}

}
