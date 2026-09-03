<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverview;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Service;
use App\Models\Devis;
use App\Models\MessageContact;
use App\Models\Realisation;
use Illuminate\Support\Facades\Schema;

class StatsOverview extends BaseStatsOverview
{
    protected ?string $heading = "Vue d'ensemble";

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        // Guard against missing tables during early setup or migrations
        $servicesCount = Schema::hasTable('services') ? Service::count() : 0;
        $devisCount = Schema::hasTable('devis') ? Devis::count() : 0;
        $messagesCount = Schema::hasTable('message_contacts') ? MessageContact::where('statut', 'non_lu')->count() : 0;
        $realisationsCount = Schema::hasTable('realisations') ? Realisation::count() : 0;

        return [
            Stat::make('Services', $servicesCount)->description('Nombre de services'),
            Stat::make('Devis', $devisCount)->description('Devis reçus'),
            Stat::make('Messages', $messagesCount)->description('Messages non lus'),
            Stat::make('Réalisations', $realisationsCount)->description('Projets publiés'),
        ];
    }
}