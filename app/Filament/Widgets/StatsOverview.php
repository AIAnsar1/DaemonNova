<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use App\Models\{Advertising, Channel, Article, Post};

class StatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Каналы', Channel::count())
                ->description('Всего активных каналов'),

            Stat::make('Посты', Post::count())
                ->description('Все посты в базе'),

            Stat::make('Статьи', Article::count())
                ->description('Публикации Telegraph'),

            Stat::make('Рекламы', Advertising::count())
                ->description('Рекламные посты'),

            Stat::make('Просмотры', number_format(
                Post::sum('views') + Article::sum('views') + Advertising::sum('views')
            ))->description('Всего просмотров контента'),

            Stat::make('Реакции', number_format(
                Post::sum('reactions_count') + Article::sum('reactions_count') + Advertising::sum('reactions_count')
            ))->description('Всего реакций на публикации'),
        ];
    }
}