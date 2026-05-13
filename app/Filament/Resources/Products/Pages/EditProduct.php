<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * Intercept form data before validation
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::channel('stack')->info('🔍 [ProductEdit] Data Before Update:', [
            'received_data' => $data,
            'thumbnail_field' => $data['thumbnail'] ?? 'NOT_PROVIDED',
        ]);

        return $data;
    }

    /**
     * Handle the actual record update
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        Log::channel('stack')->info('📝 [ProductEdit] Updating Product with data:', $data);

        $record->update($data);

        Log::channel('stack')->info('✅ [ProductEdit] Product Updated:', [
            'id' => $record->id,
            'name' => $record->name,
            'thumbnail_saved' => $record->thumbnail,
        ]);

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
