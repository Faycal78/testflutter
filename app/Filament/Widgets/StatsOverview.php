<?php

namespace App\Filament\Widgets;

use App\Models\ServiceRequest;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Utilisateurs', User::count())
                ->icon('heroicon-o-users')
                ->description('Total utilisateurs')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make('Demandes', ServiceRequest::count())
                ->icon('heroicon-o-document-text')
                ->description('Total demandes')
                ->chart([3, 5, 8, 12, 6, 9, 15])
                ->color('primary'),

            Stat::make('Urgentes', ServiceRequest::where('is_urgent', true)->count())
                ->icon('heroicon-o-exclamation-triangle')
                ->description('Demandes urgentes')
                ->chart([1, 3, 2, 5, 4, 7, 3])
                ->color('danger'),
        ];
    }
}
