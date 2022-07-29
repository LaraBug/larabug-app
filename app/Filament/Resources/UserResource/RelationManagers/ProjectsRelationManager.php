<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class ProjectsRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'projects';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_exceptions')
                    ->sortable(),

                Tables\Columns\BooleanColumn::make('notifications_enabled')
                    ->label('Notifications'),
            ])
            ->filters([
                //
            ])
            ->defaultSort('title');
    }

    protected function canDelete(Model $record): bool
    {
        return false;
    }

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canEdit(Model $record): bool
    {
        return false;
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn ($record) => route('filament.resources.projects.edit', $record->id);
    }
}
