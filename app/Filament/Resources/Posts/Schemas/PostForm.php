<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\{Get, Set};
use Filament\Forms\Components\{DateTimePicker, FileUpload, MarkdownEditor, RichEditor, Select, TextInput, Textarea, Hidden, Toggle};


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('contents')
                    ->multiple()
                    ->required()
                    ->disk('public')
                    ->directory('posts')
                    ->visibility('public'),
                TextInput::make('title')
                    ->required(),
                MarkdownEditor::make('description')
                    ->columnSpanFull(),
                Toggle::make('publish_now')->label('Опубликовать сразу')->default(false)->live(),
                DateTimePicker::make('publish_date')->required()->visible(fn (Get $get) => !$get('publish_now'))->default(now()->addHour()),
                Hidden::make('publish_date')->dehydrateStateUsing(function (Get $get) {
                    if ($get('publish_now')) {
                        return now();
                    }
                    return $get('publish_date');
                }),
                Select::make('status')
                    ->label('Статус поста')
                    ->options([
                        'draft' => 'Черновик',
                        'scheduled' => 'Запланирован',
                        'published' => 'Опубликован',
                        'failed' => 'Ошибка',
                    ])
                    ->default('draft')
                    ->required()
                    ->native(false),
                Select::make('language')
                    ->required()
                    ->options([
                        'ru' => 'Русский',
                        'en' => 'English',
                        'uz' => 'Uzbek',
                    ])
                    ->default('en'),
                Select::make('tag_id')->label('Tag')->relationship('tags', 'title')->required()->multiple()->searchable(),
                Select::make('channels_id')->label('Channel')->relationship('channel', 'name')->required()->searchable(),
            ]);
    }
}
