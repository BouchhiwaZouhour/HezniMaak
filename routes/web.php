<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChauffeurDashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TaxiController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentification requise
Route::middleware('auth')->group(function () {
    // Routes pour le profil utilisateur

    //ajouter condition pour client et chauffeur 
    Route::get('/chauffeur/dashbord', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/chauffeur/dashbord', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/chauffeur/dashbord', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les réservations
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/reservations', function () {
        return redirect('/');
    });
    Route::get('/rechercher-taxis', [ReservationController::class, 'listAvailableTaxis'])->name('taxi.recherche');

    //filtrage de reservations
    Route::get('/reservations/taxi/{taxi_id}',[ReservationController::class,'getReservationsByTaxi'])->name('reservation.taxi');
    Route::get('/reservations/chauffeur/{chauffeur_id}', [ReservationController::class, 'getReservationsByChauffeur'])->name('reservations.chauffeur');
    
    
    //liste reservations de client
    Route::get('/reservations/client/{client_id}', [ReservationController::class, 'getReservationsByClient'])->name('reservations.client');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // confirmer reservation 
    Route::post('/reservations/{reservation_id}/confirm', [ReservationController::class, 'confirmReservation'])->name('reservations.confirm');

    // Routes pour le tableau de bord des chauffeurs
    Route::match(['get', 'post'], '/chauffeur/dashbord', [ChauffeurDashboardController::class, 'index'])
        ->name('chauffeur.dashbord')
        ->middleware('role:chauffeur'); // Middleware pour vérifier le rôle chauffeur
    Route::get('/chauffeur/reservations', [ReservationController::class, 'showDashboard'])->name('chauffeur.reservations');

    // Gestion des taxis
    Route::get('/chauffeur/taxi/add', [TaxiController::class, 'create'])->name('taxi.create');
    Route::post('/chauffeur/taxi/add', [TaxiController::class, 'store'])->name('taxi.store');
    Route::get('/taxis/disponibles', [TaxiController::class, 'available'])->name('taxis.liste');
    Route::put('/taxis/{id}', [TaxiController::class, 'update'])->name('taxis.update');
    Route::get('/taxis/{id}/edit', [TaxiController::class, 'edit'])->name('taxi.edit');
    Route::delete('/taxis/{taxi}', [TaxiController::class, 'destroy'])->name('taxi.destroy');

   /* Route::get('/taxis/nearby', [TaxiController::class, 'nearby'])->name('taxis.nearby');
Route::post('/taxi/update-position', [TaxiController::class, 'updatePosition'])
    ->middleware('auth')
    ->name('taxi.update-position');*/
    //page about 
    
});

// Tableau de bord (authentification et vérification requises)
Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about')->name('about');
// Inclusion des routes pour l'authentification (Laravel Breeze ou Jetstream)
require __DIR__ . '/auth.php';
