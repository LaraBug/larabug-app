<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Resources\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Resources\Tables\Table;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Forms\Components;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\Forms\Components\Abilities;

class UserResource extends Resource
{
    public static $icon = 'heroicon-o-users';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')->autofocus()->required(),
                Grid::make([
                    Components\Checkbox::make('is_admin'),
                ])->columns(2),

                Components\Tabs::make('Test')
                    ->tabs([
                        Components\Tab::make(
                            'Abilities',
                            [
                                Abilities::make('abilities')->label(false),
                            ],
                        ),
                    ]),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->searchable()->primary(),
                Columns\Text::make('email')->searchable(),
                Columns\Text::make('created_at')->label('Registered at')->sortable(),
                Columns\Boolean::make('is_admin'),
            ])
            ->filters([
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
            Pages\ListUsers::routeTo('/', 'index'),
            Pages\CreateUser::routeTo('/create', 'create'),
            Pages\EditUser::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
