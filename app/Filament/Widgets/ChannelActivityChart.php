<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Channel;


class ChannelActivityChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'channelActivityChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Активность каналов';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $channels = Channel::select('title', 'views_total')->orderByDesc('views_total')->take(5)->pluck('views_total', 'title');

        return [
            'chart' => ['type' => 'donut', 'height' => 350],
            'series' => array_values($channels->toArray()),
            'labels' => $channels->keys(),
            'colors' => ['#3B82F6', '#EF4444', '#F59E0B', '#10B981', '#8B5CF6'],
        ];
    }
}
