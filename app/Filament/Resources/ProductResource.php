<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class ProductResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static $label = 'Productos';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->label('Nombre del producto')
                    ->required()
                    ->autofocus(),
                Components\Textarea::make('description')
                    ->label('Descripción')
                    ->nullable(),
                Components\TextInput::make('price')
                    ->label('Precio')
                    ->placeholder('Bs')
                    ->numeric()
                    ->min(0)
                    ->required()
                    ->extraAttributes(['min' => 0, 'step' => 0.1]),
                Components\TextInput::make('offer_price')
                    ->label('Precio de oferta')
                    ->placeholder('Bs')
                    ->numeric()
                    ->nullable()
                    ->extraAttributes(['min' => 0, 'step' => 0.1]),
                Components\DatePicker::make('offer_limit')
                    ->label('Límite de oferta')
                    ->format('d/m/Y')
                    ->nullable(),
                Components\Checkbox::make('is_visible')
                    ->label('¿Visible?')
                    ->helpMessage('Si marcas esta casilla, el producto será visible en la tienda'),
                Components\KeyValue::make('properties')
                    ->label('Propiedades')
                    ->addButtonLabel('Agregar fila') // Set the add button label. It supports localization strings.
                    ->deleteButtonLabel('Eliminar fila') // Set the delete button label. It supports localization strings.
                    ->keyLabel('Propiedades') // Set the key field label label. It supports localization strings.
                    ->keyPlaceholder('Propiedad') // Set the key field placeholder. It supports localization strings.
                    ->sortable() // Allow the keys to be sorted using drag and drop.
                    ->sortButtonLabel('set buton label') // Set the sort button label. It supports localization strings.
                    ->valueLabel('Valores') // Set the value field label label. It supports localization strings.
                    ->valuePlaceholder('Valor'), // Set the value field placeholder. It supports localization strings.
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')
                    ->primary()
                    ->label('Nombre')
                    ->url(fn ($product) => "/{$product->slug}", true)
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('price')
                    ->label('Precio (Bs)')
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('offer_price')
                    ->label('Precio de oferta (Bs)')
                    ->searchable()
                    ->sortable(),
                Columns\Text::make('offer_limit')
                    ->label('Límite de oferta')
                    ->date('d/m/Y')
                    ->searchable()
                    ->sortable(),
                Columns\Boolean::make('is_visible')
                    ->label('¿Visible?')
                    ->searchable()
                    ->sortable(),
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
            Pages\ListProducts::routeTo('/', 'index'),
            Pages\CreateProduct::routeTo('/create', 'create'),
            Pages\EditProduct::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
