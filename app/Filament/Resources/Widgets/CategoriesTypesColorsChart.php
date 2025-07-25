<?php

namespace App\Filament\Widgets;

use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\Type;
use Filament\Widgets\ChartWidget;

class CategoriesTypesColorsChart extends ChartWidget
{
    protected static ?string $heading = 'Categories, Types & Colors Distribution';

     protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Total',
                    'data' => [
                        ProductCategory::count(),
                        Type::count(),
                        ProductColor::count(),
                    ],
                    'backgroundColor' => [
                        '#3B82F6', // blue for Categories
                        '#10B981', // green for Types
                        '#F59E0B', // yellow for Colors
                    ],
                ],
            ],
            'labels' => ['Categories', 'Types', 'Colors'],
        ];
    }

    protected function getType(): string
    {
        return 'pie'; 
    }
}
