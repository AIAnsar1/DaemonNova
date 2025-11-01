<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\{Post, Article, Advertising};

class ViewsChart extends ApexChartWidget
{
    protected static ?int $sort = 6;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'viewsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Просмотры по месяцам';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $postViews = Post::select(DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"), DB::raw('SUM(views) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $articleViews = Article::select(DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"), DB::raw('SUM(views) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $adViews = Advertising::select(DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"), DB::raw('SUM(views) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Общий список месяцев
        $months = collect(array_keys($postViews))
            ->merge(array_keys($articleViews))
            ->merge(array_keys($adViews))
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $mapValues = function (array $source) use ($months) {
            return array_map(fn($m) => (int) ($source[$m] ?? 0), $months);
        };

        // Создадим суммарную серию (posts+articles+ads) и, при желании, можно показать по типам
        $totalPerMonth = array_map(
            fn($i) => $mapValues($postViews)[$i] + $mapValues($articleViews)[$i] + $mapValues($adViews)[$i],
            array_keys($months)
        );

        return [
            'chart' => ['type' => 'area', 'height' => 350],
            'series' => [
                ['name' => 'Суммарные просмотры', 'data' => $totalPerMonth],
                // при желании можно добавить отдельные серии:
                ['name' => 'Посты', 'data' => $mapValues($postViews)],
                ['name' => 'Статьи', 'data' => $mapValues($articleViews)],
                ['name' => 'Рекламы', 'data' => $mapValues($adViews)],
            ],
            'xaxis' => ['categories' => $months],
            'colors' => ['#6366F1', '#F59E0B', '#10B981', '#EF4444'],
            'fill' => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1]],
            'stroke' => ['curve' => 'smooth'],
            'tooltip' => ['theme' => 'dark'],
        ];
    }
}
