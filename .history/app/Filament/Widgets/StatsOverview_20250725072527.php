<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\Type;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products', Product::count())
                ->description('Total Products')
                ->color('danger')
                ->icon('heroicon-o-archive-box'),

            Stat::make('Categories', ProductCategory::count())
                ->description('Total Categories')
                ->color('info')
                ->icon('heroicon-o-rectangle-stack'), 

            Stat::make('Colors', ProductColor::count())
                ->description('Total Colors')
                ->color('warning')
                ->icon('heroicon-o-swatch'),

                //added aditinally types count too
            Stat::make('Types', Type::count())
                ->description('Total Types')
                ->color('success')
                ->icon('heroicon-o-swatch'),
        ];
    }
}
