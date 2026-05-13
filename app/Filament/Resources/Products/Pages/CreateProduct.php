<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * Intercept form data before validation
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::channel('stack')->info('🔍 [ProductForm] Data Before Create:', [
            'received_data' => $data,
            'thumbnail_field' => $data['thumbnail'] ?? 'MISSING',
        ]);

        return $data;
    }

    /**
     * Handle the actual record creation
     */
    protected function handleRecordCreation(array $data): Model
    {
        Log::channel('stack')->info('💾 [ProductForm] Creating Product with data:', $data);

        $model = static::getModel();
        $record = $model::create($data);

        Log::channel('stack')->info('✅ [ProductForm] Product Created:', [
            'id' => $record->id,
            'name' => $record->name,
            'thumbnail_saved' => $record->thumbnail,
        ]);

        return $record;
    }
}
