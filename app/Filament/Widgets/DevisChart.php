<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Devis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DevisChart extends ChartWidget
{
    protected ?string $heading = 'Évolution des devis (30 derniers jours)';

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        $end = Carbon::today();
        $start = (clone $end)->subDays(29);

        // If the table doesn't exist, return an empty dataset so the chart renders safely.
        if (! Schema::hasTable('devis')) {
            $labels = [];
            $data = [];

            for ($dt = clone $start; $dt->lte($end); $dt->addDay()) {
                $labels[] = $dt->format('Y-m-d');
                $data[] = 0;
            }
        } else {
            // Fetch counts grouped by date
            $rows = Devis::query()
                ->selectRaw("DATE(created_at) as date, COUNT(*) as total")
                ->whereBetween('created_at', [$start->startOfDay(), $end->endOfDay()])
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('total', 'date')
                ->toArray();

            $labels = [];
            $data = [];

            for ($dt = clone $start; $dt->lte($end); $dt->addDay()) {
                $label = $dt->format('Y-m-d');
                $labels[] = $label;
                $data[] = isset($rows[$label]) ? (int) $rows[$label] : 0;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Devis',
                    'data' => $data,
                    'backgroundColor' => 'rgba(0,158,226,0.08)',
                    'borderColor' => '#009EE2',
                    'tension' => 0.3,
                    'pointRadius' => 3,
                ],
            ],
        ];
    }
}