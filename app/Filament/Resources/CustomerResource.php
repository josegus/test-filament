<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Components\Checkbox;
use Filament\Resources\Forms\Components\DatePicker;
use Filament\Resources\Forms\Components\Select;
use Filament\Resources\Forms\Components\Textarea;
use Filament\Resources\Forms\Components\TextInput;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class CustomerResource extends Resource
{
    public static $icon = 'heroicon-o-user-group';

    public static $label = 'Clientes';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre completo')
                    ->placeholder('Luis Suarez')
                    ->helpMessage('Ingresa al menos un apellido. Usaremos el nombre completo para generar la factura')
                    ->hint('Por favor, recuerda agregar tu primer nombre y primer apellido')
                    ->autofocus()
                    ->required(),

                TextInput::make('email')
                    ->email()
                    //->unique('customers')
                    ->required(),

                TextInput::make('phone')
                    ->label('Celular')
                    ->rules(['required', 'starts_with:7,6']),

                TextInput::make('description'),
                Textarea::make('address'),
                Select::make('company')
                    ->placeholder('Empresa asociada')
                    ->options([
                        'company_a' => 'Empresa A',
                        'company_b' => 'Empresa B'
                    ]),
                TextInput::make('percentage_discount')
                    ->numeric()
                    ->min(0)
                    ->max(50)
                    ->placeholder('Porcentaje de descuento aplicado a las ventas que realice este cliente')
                    ->helpMessage('Mínimo 0%, máximo 50%'),
                Checkbox::make('is_affiliate')
                    ->default(true)
                    ->label('¿Es afiliado?')
                    ->helpMessage('Indica si este cliente está afiliado a tu empresa'),
                Datepicker::make('birthday')
                    ->displayFormat('d/m/Y')
                    ->placeholder('Fecha de nacimiento')
                    ->helpMessage('Usaremos esta fecha para enviarle un descuento adicional en su cumpleaño')
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')
                    ->primary()
                    ->sortable()
                    ->searchable(),

                Columns\Text::make('email')
                    ->url(fn ($customer) => "mailto:{$customer->email}")
                    ->sortable()
                    ->searchable(),

                Columns\Text::make('company')
                    ->options([
                        'a' => 'Company A',
                        'b' => 'Company B',
                    ]),

                Columns\Text::make('birthday')
                    ->date('F j'),

                Columns\Boolean::make('is_affiliate')
                    ->label('Afiliado?'),
            ])
            ->filters([
                Filter::make('Empresa A', fn ($query) => $query->where('company', 'company_a')),
                Filter::make('Empresa B', fn ($query) => $query->where('company', 'company_b')),
                Filter::make('Afiliado', fn ($query) => $query->where('is_affiliate', true)),
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
            Pages\ListCustomers::routeTo('/', 'index'),
            Pages\CreateCustomer::routeTo('/create', 'create'),
            Pages\EditCustomer::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
