<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\{StatsOverview, ChannelActivityChart, PostsGrowthChart, StatusDistributionChart, TopPostsChart, ViewsChart};

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ChannelActivityChart::class,
            PostsGrowthChart::class,
            StatusDistributionChart::class,
            TopPostsChart::class,
            ViewsChart::class,
        ];
    }

    public function getColumns(): int|array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'xl' => 3,
        ];
    }
}
