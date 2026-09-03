<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $iconsByTitle = [
            'Pull Out Test (POT) – Essais de résistance à l\'arrachement' => 'heroicon-o-beaker',
            'Montage des structures photovoltaïques' => 'heroicon-o-wrench-screwdriver',
            'Piquetage et installation des pieux photovoltaïques' => 'heroicon-o-map-pin',
            'Tirage et raccordement des câbles AC – BT et MT' => 'heroicon-o-bolt',
            'Installation des panneaux photovoltaïques' => 'heroicon-o-squares-2x2',
            'Tirage et raccordement des câbles DC photovoltaïques' => 'heroicon-o-link',
            'Installation de lampadaires solaires' => 'heroicon-o-light-bulb',
            'Installation de systèmes de vidéosurveillance' => 'heroicon-o-video-camera',
            'Essais électriques, contrôle qualité et tests de conformité' => 'heroicon-o-magnifying-glass',
            'Installation résidentielle' => 'heroicon-o-home-modern',
            'Installation professionnelle' => 'heroicon-o-building-office-2',
            'Maintenance' => 'heroicon-o-wrench-screwdriver',
            'Audit énergétique' => 'heroicon-o-clipboard-document-check',
        ];

        foreach ($iconsByTitle as $title => $icon) {
            DB::table('services')->where('titre', $title)->update(['icone' => $icon]);
        }
    }

    public function down(): void
    {
    }
};