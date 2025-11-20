<?php

namespace App\Providers;

use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $user = Auth::user();

        //    if ($user) {
        //         if ($user->isSuperAdmin()) {
        //            $view->with([
        //                 'entreprises' => Entreprise::all(),
        //                 'entreprise' => null,
        //             ]);
        //         } else {
        //             $view->with([
        //                 'entreprises' => collect([$user->entreprise]),
        //                 'entreprise' => $user->entreprise ?? null,
        //             ]);
        //         }
        //     } else {
        //         // Aucun utilisateur connecté
        //         $view->with([
        //             'entreprises' => collect([]),
        //             'entreprise' => null,
        //         ]);
        //     }
        });
    }
}
