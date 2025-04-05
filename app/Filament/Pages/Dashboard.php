<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ServiceRequest;
use App\Models\Offer;
use App\Models\Category;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    // Variables accessibles dans la vue
    public $totalRequests = 0;
    public $totalOffers = 0;
    public $totalCategories = 0;
    public $dailyRequests = [];
    public $dailyOffers = [];

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    public function mount(): void
    {
        // Initialisation des statistiques
        $this->totalRequests   = ServiceRequest::count();
        $this->totalOffers     = Offer::count();
        $this->totalCategories = Category::count();

        $this->dailyRequests = ServiceRequest::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $this->dailyOffers = Offer::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }
}
