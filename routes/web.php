<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('welcome');
});

    // Page de login (accessible sans middleware)
    Route::get('/auth', [AuthController::class, 'login'])->name('login');
    Route::post('/dologin', [AuthController::class, 'doLogin'])->name('auth.doLogin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');


// Protection par middleware (auth)
// Route::middleware(['auth', 'check.licence', 'feature.access'])->name('admin.')->group(function () {

    // Route::get('/reset-password', [AuthController::class, 'logout'])->name('resetPasswordForm');
    // Route::post('/resetPassword-Store', [AuthController::class, 'logout'])->name('resetPasswordStore');s
   
    // Déconnexion

    // Changement de mot de passe après première connexion
    Route::get('/password/change', [AuthController::class, 'passwordChangeForm'])->name('password-change');
    Route::post('/password/change', [AuthController::class, 'passwordChangeStore'])->name('password-change-store');

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index'); // page principale
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profils
    |--------------------------------------------------------------------------
    */
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilController::class, 'profil'])->name('index');
        Route::get('/create/{id?}', [ProfilController::class, 'createForm'])->name('create');
        Route::post('/store/{id?}', [ProfilController::class, 'storeOrUpdate'])->name('store');
        Route::delete('/delete/{id}', [ProfilController::class, 'delete'])->name('delete');
    });
    
     /*
    |--------------------------------------------------------------------------
    | Utilisateurs
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create/{id?}', [UserController::class, 'createForm'])->name('form');
        Route::get('/reset/{id?}', [UserController::class, 'resetUser'])->name('reset');
        Route::post('/store/{id?}', [UserController::class, 'storeOrUpdate'])->name('store');
        Route::get('/show/{id}', [UserController::class, 'showUser'])->name('show');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('paiements')->group(function () {
        Route::get('/', [PaiementController::class, 'indexView'])->name('paiements.index');
        Route::post('/store', [PaiementController::class, 'store'])->name('paiements.store');
        // Route::get('/{id}', [PaiementController::class, 'show']);
        // Route::delete('/{id}', [PaiementController::class, 'destroy']);
        // Situation d’un utilisateur
        Route::get('/user/{userId}/status', [PaiementController::class, 'userStatus']);
        Route::get('/create', [PaiementController::class, 'createView'])->name('paiements.create');
        Route::get('/{id}/show', [PaiementController::class, 'showView'])->name('paiements.show');
        Route::get('/user/{userId}/status-view', [PaiementController::class, 'userStatusView'])->name('paiements.user.status');
        // API endpoints (déjà fournis précédemment)
        // Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
});

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\AdminDashboardController;

    Route::get('abonnements/create', [AbonnementController::class, 'create'])->name('abonnements.create');
    Route::post('abonnements', [AbonnementController::class, 'store'])->name('abonnements.store');
    Route::get('abonnements/{id}/edit', [AbonnementController::class, 'edit'])->name('abonnements.edit');
    Route::put('abonnements/{id}', [AbonnementController::class, 'update'])->name('abonnements.update');
    Route::delete('abonnements/{id}', [AbonnementController::class, 'destroy'])->name('abonnements.destroy');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

 

// });
    