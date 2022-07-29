<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationResource\Pages;
use App\Filament\Resources\DocumentationResource\RelationManagers;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Docs';

    protected static ?string $label = 'Page';

    protected static ?string $pluralLabel = 'Pages';

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

                    Forms\Components\BelongsToSelect::make('documentation_category_id')
                        ->relationship('category', 'title')
                        ->preload(),

                    Forms\Components\MarkdownEditor::make('content')
                        ->columnSpan(2),

                ])
                ->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit'),
        ];
    }
}
