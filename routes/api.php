<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ServiceRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Ces routes utilisent le middleware 'auth:sanctum' et ne démarrent pas de session.
|
*/

// Routes publiques (sans authentification)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Exemple de route publique si nécessaire
Route::get('/users', [AuthController::class, 'index']);

// Routes protégées par Sanctum (token-based)
Route::middleware('auth:sanctum')->group(function () {

    // Route pour obtenir l'utilisateur authentifié
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes pour les clients
    Route::middleware('role:client')->group(function () {
        // Création d'une demande de service
        Route::post('/service-requests', [ServiceRequestController::class, 'store']);
        // Affichage des offres pour une demande spécifique
        Route::get('/service-requests/{id}/offers', [OfferController::class, 'index']);
    });

    // Routes pour les fournisseurs (providers)
    Route::middleware('role:provider')->group(function () {
        // Liste des demandes de service
        Route::get('/service-requests', [ServiceRequestController::class, 'index']);
        // Création d'une offre pour une demande spécifique
        Route::post('/service-requests/{id}/offers', [OfferController::class, 'store']);
    });
});
