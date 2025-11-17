<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetEntrepriseContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request);
        }

        // Si super-admin, il peut choisir une entreprise
        if ($user->profil->libelle === 'Super-admin') {
            if ($request->has('entreprise_id')) {
                session(['entreprise_id' => $request->get('entreprise_id')]);
            }

            if (!session()->has('entreprise_id')) {
                session(['entreprise_id' => null]);
            }
        } else {
            // Pour admin ou utilisateur classique
            session(['entreprise_id' => $user->entreprises_id]);
        }

        return $next($request);
    }
}
