<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Filament\Resources\CategoryResource;
use App\Http\Controllers\ServiceRequestController;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/service-requests', [ServiceRequestController::class, 'store'])
         ->middleware('role:client');
});


Route::middleware(['auth:sanctum', 'role:provider'])->get('/service-requests', [ServiceRequestController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:provider'])
     ->post('/service-requests/{id}/offers', [OfferController::class, 'store']);

     Route::middleware(['auth:sanctum', 'role:client'])
     ->get('/service-requests/{id}/offers', [OfferController::class, 'index']);
     Route::get('/admin/logout', function () {
        Auth::logout();
        return redirect()->route('filament.auth.login'); // Assurez-vous que cette route existe ou redirigez vers la page de connexion souhaitée
    })->name('filament.auth.logout');


    use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'verified'])
    ->prefix(config('filament.path')) // souvent 'admin'
    ->group(function () {
        Route::resource('categories', CategoryResource::class)
            ->names([
                'index'  => 'filament.resources.categories.index',
                'create' => 'filament.resources.categories.create',
                'edit'   => 'filament.resources.categories.edit',
                'destroy'   => 'filament.resources.categories.destroy',
                // Les autres actions seront également nommées en conséquence
            ]);
    });


    Route::middleware(['auth', 'verified']) // ou vos middlewares administratifs
    ->prefix('admin')
    ->group(function () {
        // Page de liste des catégories
        Route::get('categories', [ListCategories::class, '__invoke'])
            ->name('filament.admin.resources.categories.index');

        // Page de création d'une catégorie
        Route::get('categories/create', [CreateCategory::class, '__invoke'])
            ->name('filament.admin.resources.categories.create');

        // Page d'édition d'une catégorie
        Route::get('categories/{record}/edit', [EditCategory::class, '__invoke'])
            ->name('filament.admin.resources.categories.edit');

        // Route pour la suppression (si définie dans votre composant)
        Route::delete('categories/{record}', [ListCategories::class, 'destroy'])
            ->name('filament.admin.resources.categories.destroy');
    });
