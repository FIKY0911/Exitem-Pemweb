<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner Content')
                    ->schema([
                        TextInput::make('brand_name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('brand_icon')
                            ->image()
                            ->directory('banners/icons')
                            ->hint('Upload a brand logo (e.g. Apple logo)'),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Call to Action')
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Link to Product')
                            ->hint('Choose a product to redirect to when "Shop Now" is clicked'),
                    ]),
                Section::make('Image & Status')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('banners')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->default(false),
                    ]),
            ]);
    }
}
