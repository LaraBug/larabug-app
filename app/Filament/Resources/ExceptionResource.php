<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Resources\Forms\Form;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Forms\Components;
use App\Filament\Resources\ExceptionResource\Pages;

class ExceptionResource extends Resource
{
    public static $icon = 'heroicon-o-fire';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('Exception')->autofocus()->required(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('exception')
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListExceptions::routeTo('/', 'index'),
            Pages\CreateException::routeTo('/create', 'create'),
            Pages\EditException::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
