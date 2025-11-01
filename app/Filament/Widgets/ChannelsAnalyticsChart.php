<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Channel;
use Illuminate\Support\Facades\DB;

class ChannelsAnalyticsChart extends ApexChartWidget
{
    protected static ?int $sort = 2;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'channelsAnalyticsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ChannelsAnalyticsChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $data = Channel::select(DB::raw('DATE(last_synced_at) as date'),DB::raw('SUM(members_count) as total_members'),DB::raw('SUM(views_total) as total_views'))->groupBy('date')->orderBy('date')->get();
        
        return [
            'chart' => [
                'type' => 'line',
                'height' => 350,
                'toolbar' => ['show' => false],
                'zoom' => ['enabled' => false],
            ],
            'series' => [
                [
                    'name' => 'Подписчики',
                    'data' => $data->pluck('total_members'),
                ],
                [
                    'name' => 'Просмотры',
                    'data' => $data->pluck('total_views'),
                ],
            ],
            'xaxis' => [
                'categories' => $data->pluck('date'),
                'labels' => [
                    'style' => [
                        'colors' => '#A1A1AA',
                        'fontSize' => '12px',
                    ],
                ],
            ],
            'colors' => ['#3B82F6', '#F59E0B'], // Синие и оранжевые линии
            'stroke' => [
                'curve' => 'smooth',
                'width' => 3,
            ],
            'legend' => [
                'position' => 'top',
                'labels' => ['colors' => '#E5E7EB'],
            ],
            'grid' => [
                'borderColor' => '#374151',
                'strokeDashArray' => 4,
            ],
            'tooltip' => [
                'theme' => 'dark',
            ],
        ];
    }
}
