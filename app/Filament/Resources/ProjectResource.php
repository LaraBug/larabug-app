<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Resources\Forms\Form;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Forms\Components;
use App\Filament\Resources\ProjectResource\Pages;

class ProjectResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('title')->autofocus()->required(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('title')->searchable(),
                Columns\Text::make('created_at')->sortable(),
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
            Pages\ListProjects::routeTo('/', 'index'),
            Pages\CreateProject::routeTo('/create', 'create'),
            Pages\EditProject::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
