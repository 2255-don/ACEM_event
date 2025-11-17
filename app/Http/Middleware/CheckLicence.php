<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        $profil = strtolower($user->profil->libelle ?? '');
        $entreprise = $user->entreprise;

        if ($profil === 'super-admin') {
            return $next($request);
        }

        if ($entreprise && $profil === 'employer') {
            $licence = $entreprise->licence;

            if (!$licence || $licence->etat !== 'active') {
                return redirect()->route('login')
                    ->with('error', 'Accès refusé : votre entreprise n’a pas de licence active.');
            }

            return $next($request);
        }

        if ($entreprise && $profil === 'admin') {
            $licence = $entreprise->licence;
            // dd($licence);

            if (!$licence || $licence->etat !== 'active') {
                return redirect()->route('licence.paiement')
                    ->with('error', 'Votre licence est inactive ou expirée.');
            }

            return $next($request);
        }

        return redirect()->route('login')->with('error', "Accès non autorisé.");
    }
}
