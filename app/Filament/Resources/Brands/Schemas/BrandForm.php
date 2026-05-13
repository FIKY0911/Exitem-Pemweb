<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Brand Identity')
                    ->description('Informasi visual dan identitas brand.')
                    ->schema([
                        ComponentsGrid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Brand Name')
                                    ->required()
                                    ->live(onBlur: true),

                                TextInput::make('slug')
                                    ->label('Brand Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(ignoreRecord: true),
                            ]),

                        FileUpload::make('logo')
                            ->label('Brand Logo')
                            ->image()
                            ->disk('public') // Wajib simpan di disk public
                            ->directory('brands')
                            ->visibility('public')
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
