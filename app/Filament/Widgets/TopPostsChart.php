<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Post;


class TopPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'topPostsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ТОП постов по просмотрам';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $top = Post::orderByDesc('views')->take(5)->pluck('views', 'title');

        return [
            'chart' => ['type' => 'bar', 'height' => 350],
            'series' => [['name' => 'Просмотры', 'data' => array_values($top->toArray())]],
            'xaxis' => ['categories' => $top->keys()],
            'colors' => ['#FBBF24'],
        ];
    }
}
