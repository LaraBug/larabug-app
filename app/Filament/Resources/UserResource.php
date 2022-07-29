<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\RelationManagers\ProjectsRelationManager;
use Filament\Resources\Form;
use Filament\Tables\Columns;
use Filament\Resources\Table;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Card::make()->schema([
                    Components\TextInput::make('email')
                        ->required(),

                    Components\TextInput::make('name')
                        ->required(),

                    Grid::make()
                        ->schema([
                            Components\Toggle::make('is_admin')
                                ->helperText('This option grants access to this admin panel'),
                        ]),

                    Components\MultiSelect::make('abilities')
                        ->options(config('auth.abilities'))
                        ->helperText('This can be used to give the user some extra features'),
                ])->columns(),
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
            ProjectsRelationManager::class,
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
