<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class UsersRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'users';

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
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ]);
    }

    protected function canDelete(Model $record): bool
    {
        return false;
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn ($record) => route('filament.resources.users.edit', $record->id);
    }
}
