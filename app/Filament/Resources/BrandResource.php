<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class BrandResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static $label = 'Marcas';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Components\Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Opcional. Descripción corta de esta marca (máximo 200 caracteres)')
                    ->rules(['max:200'])
                    ->extraAttributes(['max' => 200]),
                Components\RichEditor::make('content')
                    ->label('Contenido')
                    ->attachmentDisk('public')
                    ->placeholder('Opcional. Escribe aquí una descripción extendida sobre esta marca'),
                Components\FileUpload::make('image')
                    //->acceptedFileTypes(['png']) // Limit the type of files that can be uploaded using an array of mime types.
                    //->avatar() // Make the field suitable for uploading and displaying a circular avatar.
                    ->disk('public') // Set a custom disk that uploaded files should be read from and written to.
                    //->directory($directory) // Set a custom directory that uploaded files should be written to.
                    ->image() // Allow only images to be uploaded.
                    //->imageCropAspectRatio($ratio) // Crop images to this certain aspect ratio when they are uploaded, e.g: '1:1'.
                    //->imagePreviewHeight('200') // Set the height of the image preview in pixels.
                    //->imageResizeTargetHeight('200') // Resize images to this height (in pixels) when they are uploaded.
                    //->imageResizeTargetWidth($width) // Resize images to this width (in pixels) when they are uploaded.
                    ->loadingIndicatorPosition($position = 'right') // Set the position of the loading indicator.
                    ->maxSize(2000) // Set the maximum size of files that can be uploaded, in kilobytes.
                    //->minSize($size) // Set the minimum size of files that can be uploaded, in kilobytes.
                    //->panelAspectRatio('1:1') // Set the aspect ratio of the panel, e.g: '1:1'.
                    //->panelLayout($layout) // Set the layout of the panel.
                    ->placeholder('Opcional. Agrega una imagen') // Set the placeholder for when no file has been uploaded. It supports localization strings.
                    ->removeUploadButtonPosition($position = 'left') // Set the position of the remove upload button.
                    ->uploadButtonPosition($position = 'right') // Set the position of the upload button.
                    ->uploadProgressIndicatorPosition($position = 'right') // Set the position of the upload progress indicator.
                    ->visibility($visibility = 'public') // Set the visibility of uploaded files.
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                //
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
            Pages\ListBrands::routeTo('/', 'index'),
            Pages\CreateBrand::routeTo('/create', 'create'),
            Pages\EditBrand::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
