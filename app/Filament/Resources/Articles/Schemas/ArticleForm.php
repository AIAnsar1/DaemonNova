<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('content'),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('author_name'),
                TextInput::make('author_url')
                    ->url(),
                DateTimePicker::make('published_at'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('telegraph_url')
                    ->tel()
                    ->url(),
                TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('reactions_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('last_synced_at'),
                TextInput::make('channel_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
