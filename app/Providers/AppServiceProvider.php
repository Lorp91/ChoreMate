<?php

namespace App\Providers;

use App\Models\Household;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // gibt der sidebar household und rooms des users
        View::composer('components.layout.sidebar', function ($view) {
            $user = Auth::user();

            $currentHousehold = null;
            $currentRooms = collect();

            if ($user) {
                $routeHousehold = request()->route('household');

                if ($routeHousehold instanceof Household) {
                    $currentHousehold = $routeHousehold->load('rooms');
                } elseif ($routeHousehold) {
                    $currentHousehold = Household::with('rooms')->find($routeHousehold);
                } else {
                    $currentHousehold = $user->households()->with('rooms')->first();
                }

                if ($currentHousehold instanceof Collection) {
                    $currentHousehold = $currentHousehold->first();
                }

                if ($currentHousehold) {
                    $currentRooms = $currentHousehold->rooms;
                }
            }

            $view->with([
                'currentHousehold' => $currentHousehold,
                'currentRooms' => $currentRooms,
            ]);
        });
    }
}
