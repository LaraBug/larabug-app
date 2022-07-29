<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationCategoryResource\Pages;
use App\Models\DocumentationCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\IconButtonAction;
use Illuminate\Support\Str;

class DocumentationCategoryResource extends Resource
{
    protected static ?string $model = DocumentationCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = 'Docs';

    protected static ?string $label = 'Category';

    protected static ?string $pluralLabel = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('title')
                        ->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug'),
                ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_column')
                    ->hidden(),

                Tables\Columns\TextColumn::make('title'),

                Tables\Columns\TextColumn::make('slug'),
            ])
            ->filters([
                //
            ])
            ->prependActions([
                IconButtonAction::make('move up')
                    ->icon('heroicon-o-arrow-circle-up')
                    ->color(fn ($record) => $record->isFirstInOrder() ? 'gray' : 'primary')
                    ->action(fn ($record) => !$record->isFirstInOrder() ? $record->moveOrderUp() : null),

                IconButtonAction::make('move down')
                    ->icon('heroicon-o-arrow-circle-down')
                    ->color(fn ($record) => $record->isLastInOrder() ? 'gray' : 'primary')
                    ->action(fn ($record) => !$record->isLastInOrder() ? $record->moveOrderDown() : null)
            ])
            ->defaultSort('order_column');
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
            'index' => Pages\ListDocumentationCategories::route('/'),
            'create' => Pages\CreateDocumentationCategory::route('/create'),
            'edit' => Pages\EditDocumentationCategory::route('/{record}/edit'),
        ];
    }
}
