<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\RelationManagers\UsersRelationManager;
use Filament\Resources\Form;
use Filament\Tables\Columns;
use Filament\Resources\Table;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use App\Filament\Resources\ProjectResource\Pages;

class ProjectResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Card::make()->schema([
                    Components\TextInput::make('title')->autofocus()->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('title')
                    ->searchable(),

                Columns\TextColumn::make('total_exceptions')
                    ->sortable(),

                Columns\TextColumn::make('users.email')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => route('filament.resources.users.edit', $record->users()->first()?->id)),

                Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),

                Columns\BooleanColumn::make('notifications_enabled')
                    ->label('Notifications'),

                Columns\BooleanColumn::make('receive_email')
                    ->label('Email'),

                Columns\BooleanColumn::make('mobile_notifications_enabled')
                    ->label('Mobile'),

                Columns\BooleanColumn::make('slack_webhook_enabled')
                    ->label('Slack'),

                Columns\BooleanColumn::make('discord_webhook_enabled')
                    ->label('Discord'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
