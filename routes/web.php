<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Client\AuthenticatedSessionController;
use App\Http\Controllers\Client\PasswordController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\PasswordResetController;

Route::get('/', [SiteController::class, 'accueil'])->name('site.accueil');
Route::get('/a-propos', [SiteController::class, 'aPropos'])->name('site.a-propos');
Route::get('/services', [SiteController::class, 'services'])->name('site.services');
Route::get('/services/{service:slug}', [SiteController::class, 'serviceDetail'])->name('site.services.show');
Route::get('/realisations', [SiteController::class, 'realisations'])->name('site.realisations');
Route::get('/realisations/{realisation:slug}', [SiteController::class, 'realisationDetail'])->name('site.realisations.show');
Route::get('/ressources', [SiteController::class, 'ressources'])->name('site.ressources');
Route::get('/ressources/{article:slug}', [SiteController::class, 'articleDetail'])->name('site.articles.show');
Route::get('/devis', [SiteController::class, 'devis'])->name('site.devis');
Route::post('/devis', [SiteController::class, 'devisStore'])->name('site.devis.store');
Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
Route::post('/contact', [SiteController::class, 'contactStore'])->name('site.contact.store');
Route::view('/mentions-legales', 'site.mentions-legales')->name('site.mentions-legales');
Route::view('/politique-de-confidentialite', 'site.politique-de-confidentialite')->name('site.politique-de-confidentialite');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('espace-client')->name('client.')->group(function () {
    Route::get('/connexion', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/connexion', [AuthenticatedSessionController::class, 'store']);
    Route::post('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/mot-de-passe-oublie', [PasswordResetController::class, 'create'])->name('password.forgot');
    Route::post('/mot-de-passe-oublie', [PasswordResetController::class, 'sendCode'])->name('password.send-code');
    Route::get('/verifier-code', [PasswordResetController::class, 'verify'])->name('password.verify');
    Route::post('/verifier-code', [PasswordResetController::class, 'verifyCode'])->name('password.verify-code');
    Route::get('/nouveau-mot-de-passe', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/nouveau-mot-de-passe', [PasswordResetController::class, 'update'])->name('password.reset.update');

    Route::middleware('auth:client')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/demandes', [DashboardController::class, 'requests'])->name('requests');
        Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');

        Route::get('/mot-de-passe', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/mot-de-passe', [PasswordController::class, 'update'])->name('password.update');
    });
});

// Route de test mail (disponible uniquement en local)
if (app()->environment('local')) {
    Route::get('/dev/mail-test', function () {
        $email = request('email', 'test@example.test');
        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\NouveauCompteClient('Test', $email, 'password123'));
            return 'Mail envoyé à '.$email;
        } catch (\Exception $e) {
            return 'Erreur envoi : '.$e->getMessage();
        }
    });
}