<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs()
    {
        $routeName = Route::currentRouteName();
        $breadcrumbs = [];

        switch ($routeName) {
            case 'admin.dashboard':
                $breadcrumbs['Accueil'] = null;
                break;
            case 'login':
                $breadcrumbs['Accueil'] = url('/');
                $breadcrumbs['Login'] = null;
                break;
            case 'admin.profil.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Profils'] = null;
                break;
            case 'admin.profil.create':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Profils'] = route('admin.profil.index');
                $breadcrumbs['Créer'] = null;
                break;
            case 'admin.categorie.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Catégories'] = null;
                break;
            case 'admin.categorie.create':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Catégories'] = route('admin.categorie.index');
                $breadcrumbs['Créer'] = null;
                break;
            case 'admin.product.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Produits'] = null;
                break;
            case 'admin.product.create':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Produits'] = route('admin.product.index');
                $breadcrumbs['Créer'] = null;
                break;
            case 'admin.entree.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Entrées'] = null;
                break;
            case 'admin.sortie.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Sorties'] = null;
                break;
            case 'admin.user.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Utilisateurs'] = null;
                break;
            case 'admin.user.form':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Utilisateurs'] = route('admin.user.index');
                $breadcrumbs['Créer/Modifier'] = null;
                break;
            case 'admin.user.show':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Utilisateurs'] = route('admin.user.index');
                $breadcrumbs['Détails'] = null;
                break;
            case 'admin.role.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Rôles'] = null;
                break;
            case 'admin.role.form':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Rôles'] = route('admin.role.index');
                $breadcrumbs['Créer/Modifier'] = null;
                break;
            case 'admin.paiment.create':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Paiement'] = null;
                break;
            case 'admin.entreprise.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Entreprises'] = null;
                break;
            case 'admin.fournisseur.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Fournisseurs'] = null;
                break;
            case 'admin.demande.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Demandes'] = null;
                break;
            case 'admin.demande.form':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Demandes'] = route('admin.demande.index');
                $breadcrumbs['Formulaire'] = null;
                break;
            case 'admin.commande.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Commandes'] = null;
                break;
            case 'admin.analytique.index':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Analytique'] = null;
                break;
            case 'admin.commande.form':
                $breadcrumbs['Accueil'] = url('/dashboard');
                $breadcrumbs['Commandes'] = route('admin.commande.index');
                $breadcrumbs['Formulaire'] = null;
                break;

            default:
                $breadcrumbs['Accueil'] = url('/');
                $breadcrumbs['Page actuelle'] = null;
                break;
        }

        return $breadcrumbs;
    }
}