<?php

namespace App\Filament\Resources\Channels\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Forms\Components\{DateTimePicker, TextInput, Textarea, Toggle, Select};

class ChannelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('telegram_id')
                    ->label('Telegram ID')
                    ->numeric()
                    ->required()
                    ->helperText('ID канала (например, -1001234567890). Можно получить через @username_to_id_bot'),

                TextInput::make('username')
                    ->label('Username канала')
                    ->placeholder('Без @, например my_channel')
                    ->unique(ignoreRecord: true),

                TextInput::make('title')
                    ->label('Название канала')
                    ->required(),

                Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                TextInput::make('invite_link')
                    ->label('Ссылка-приглашение')
                    ->url()
                    ->helperText('Публичная ссылка для вступления'),

                // === Комментарии ===
                Toggle::make('comments_enabled')
                    ->label('Разрешены комментарии / есть группа обсуждения')
                    ->helperText('Если включено — появятся поля для настройки группы и модерации')
                    ->default(false)
                    ->live(),
                Select::make('language')
                    ->required()
                    ->options([
                        'ru' => 'Русский',
                        'en' => 'English',
                        'uz' => 'Uzbek',
                    ])
                    ->default('en'),
                // === ГРУППА ОБСУЖДЕНИЯ И МОДЕРАЦИЯ ===
                Grid::make()
                    ->columns(2)
                    ->visible(fn (Get $get): bool => (bool) $get('comments_enabled'))
                    ->schema([

                        TextInput::make('discussion_group_id')
                            ->label('ID группы обсуждения')
                            ->numeric()
                            ->helperText('Например, -1009876543210'),

                        TextInput::make('discussion_group_link')
                            ->label('Ссылка на группу')
                            ->url(),

                        Toggle::make('anti_spam_enabled')
                            ->label('Включить антиспам')
                            ->default(true),

                        Toggle::make('ban_on_link_username')
                            ->label('Банить за ссылки и @username')
                            ->default(true),

                        Textarea::make('banned_usernames')
                            ->label('Запрещённые юзернеймы')
                            ->helperText('Через запятую: spammer1, bot2')
                            ->columnSpanFull(),

                        Textarea::make('banned_links')
                            ->label('Запрещённые домены')
                            ->helperText('Через запятую: spam.com, fake.ru')
                            ->columnSpanFull(),

                        Textarea::make('banned_words')
                            ->label('Запрещённые слова')
                            ->helperText('Введите непристойные или запрещённые слова, через запятую')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
