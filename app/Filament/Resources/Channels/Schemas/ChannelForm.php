<?php

namespace App\Filament\Resources\Channels\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ChannelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('telegram_id')
                    ->tel()
                    ->required()
                    ->numeric(),
                TextInput::make('username'),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('invite_link'),
                TextInput::make('discussion_group_id')
                    ->numeric(),
                TextInput::make('discussion_group_link'),
                Toggle::make('comments_enabled')
                    ->required(),
                Toggle::make('anti_spam_enabled')
                    ->required(),
                Toggle::make('ban_on_link_username')
                    ->required(),
                TextInput::make('banned_usernames'),
                TextInput::make('banned_links'),
                TextInput::make('members_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('views_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('last_synced_at'),
            ]);
    }
}
