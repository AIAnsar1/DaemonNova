<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\{Post, Article, Advertising};


class StatusDistributionChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'statusDistributionChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Статусы публикаций';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $statuses = [
            'Черновики' => Post::where('status', 'draft')->count()
                + Article::where('status', 'draft')->count()
                + Advertising::where('status', 'draft')->count(),

            'Опубликовано' => Post::where('status', 'published')->count()
                + Article::where('status', 'published')->count()
                + Advertising::where('status', 'published')->count(),

            'Запланировано' => Post::where('status', 'scheduled')->count()
                + Article::where('status', 'scheduled')->count()
                + Advertising::where('status', 'scheduled')->count(),

            'Ошибка' => Post::where('status', 'failed')->count()
                + Article::where('status', 'failed')->count()
                + Advertising::where('status', 'failed')->count(),
        ];

        return [
            'chart' => ['type' => 'polarArea', 'height' => 350],
            'series' => array_values($statuses),
            'labels' => array_keys($statuses),
            'colors' => ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
        ];
    }
}
