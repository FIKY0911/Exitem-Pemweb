<?php

// app/Filament/Resources/Brands/Tables/BrandsTable.php

namespace App\Filament\Resources\Brands\Tables;

use Filament\Actions\ActionGroup as ActionsActionGroup;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Actions\ForceDeleteAction as ActionsForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction as ActionsForceDeleteBulkAction;
use Filament\Actions\RestoreAction as ActionsRestoreAction;
use Filament\Actions\RestoreBulkAction as ActionsRestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder-brand.png')),

                TextColumn::make('name')
                    ->label('Brand Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(), // Sekarang tidak akan error
            ])
            ->actions([
                ActionsActionGroup::make([
                    ActionsEditAction::make()->color('warning'),
                    ActionsDeleteAction::make(),
                    ActionsRestoreAction::make()->color('success'),
                    ActionsForceDeleteAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->bulkActions([
                ActionsBulkActionGroup::make([
                    ActionsDeleteBulkAction::make(),
                    ActionsRestoreBulkAction::make(),
                    ActionsForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
