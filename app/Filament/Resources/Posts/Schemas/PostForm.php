<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
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
                DateTimePicker::make('published_at'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                TextInput::make('telegram_post_id')
                    ->tel(),
                TextInput::make('post_url')
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
