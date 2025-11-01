<?php

namespace App\Filament\Resources\Channels\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ChannelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('telegram_id')
                    ->numeric(),
                TextEntry::make('username')
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('invite_link')
                    ->placeholder('-'),
                TextEntry::make('discussion_group_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('discussion_group_link')
                    ->placeholder('-'),
                IconEntry::make('comments_enabled')
                    ->boolean(),
                IconEntry::make('anti_spam_enabled')
                    ->boolean(),
                IconEntry::make('ban_on_link_username')
                    ->boolean(),
                TextEntry::make('members_count')
                    ->numeric(),
                TextEntry::make('views_total')
                    ->numeric(),
                TextEntry::make('last_synced_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
