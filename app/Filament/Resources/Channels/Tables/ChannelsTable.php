<?php

namespace App\Filament\Resources\Channels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChannelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('telegram_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('invite_link')
                    ->searchable(),
                TextColumn::make('discussion_group_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discussion_group_link')
                    ->searchable(),
                IconColumn::make('comments_enabled')
                    ->boolean(),
                IconColumn::make('anti_spam_enabled')
                    ->boolean(),
                IconColumn::make('ban_on_link_username')
                    ->boolean(),
                TextColumn::make('members_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('language')
                    ->searchable(),
                TextColumn::make('views_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('last_synced_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
