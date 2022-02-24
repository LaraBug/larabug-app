<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns;
use Filament\Forms\Components;
use App\Filament\Resources\ExceptionResource\Pages;

class ExceptionResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-fire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('exception')->autofocus()->required(),
                Components\BelongsToSelect::make('project_id')
                    ->relationship('project', 'title')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('exception'),
                Columns\TextColumn::make('project.title'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListExceptions::route('/'),
            'create' => Pages\CreateException::route('/create'),
            'edit' => Pages\EditException::route('/{record}/edit'),
        ];
    }
}
