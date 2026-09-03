<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Realisation;
use Illuminate\Support\Facades\Schema;

class RecentRealisations extends Widget
{
    protected ?string $heading = 'Dernières réalisations ajoutées';

    // Default width (will sit under or beside depending on layout). Leave flexible.
    protected int|string|array $columnSpan = 'full';

    /**
     * @var view-string
     */
    protected string $view = 'filament.widgets.recent-realisations';

    public $realisations = [];

    public function mount(): void
    {
        if (! Schema::hasTable('realisations')) {
            $this->realisations = collect([]);

            return;
        }

        $this->realisations = Realisation::query()
            ->with(['media' => fn($q) => $q->where('est_principale', 1)])
            ->latest()
            ->limit(4)
            ->get();
    }
}