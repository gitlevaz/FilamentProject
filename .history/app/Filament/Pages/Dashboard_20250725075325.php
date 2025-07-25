<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CategoriesTypesColorsChart;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets;

class Dashboard extends BaseDashboard
{ 
    public function getWidgets(): array
    {
        return [
            Widgets\AccountWidget::class,        //  account info card
            Widgets\StatsOverviewWidget::class,  //   cards
               \App\Filament\Widgets\CategoriesTypesColorsChart::class, // i nw
          
        ];
        
    }
}
