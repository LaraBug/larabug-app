<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Forms\Components\Abilities;
use Filament\Forms\Components;
use Filament\Forms\Components\Grid;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns;

class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('name')->autofocus()->required(),
                Grid::make()
                    ->schema([
                        Components\Checkbox::make('is_admin'),
                    ]),

                Components\MultiSelect::make('abilities')
                    ->options(config('auth.abilities')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')->searchable(),
                Columns\TextColumn::make('email')->searchable(),
                Columns\TextColumn::make('created_at')->label('Registered at')->sortable(),
                Columns\BooleanColumn::make('is_admin'),
            ])
            ->filters([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
