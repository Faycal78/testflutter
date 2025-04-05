<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ServiceRequest;
use App\Models\Offer;
use App\Models\Category;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    // On utilise une vue personnalisée pour le dashboard
    protected static string $view = 'filament.pages.dashboard';

    // Variables pour stocker les statistiques
    public $totalRequests;
    public $totalOffers;
    public $totalCategories; // Ajout de la variable pour les catégories

    // Titre de la page (affiché dans l'en-tête de Filament)
    public function getTitle(): string
    {
        return 'Tableau de Bord';
    }

    public function mount(): void
    {
        // Récupération des statistiques depuis la base de données
        $this->totalRequests    = ServiceRequest::count();
        $this->totalOffers      = Offer::count();
        $this->totalCategories  = Category::count();
    }
}
