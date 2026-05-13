<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'stock',
        'is_popular',
        'category_id', // Foreign Key
        'brand_id', // Foreign Key
    ];

    public function category(): BelongsTo
    {
        // untuk mendapatkan data dari relasi belongsTo dengan table category dengan kaitan category_id
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(): BelongsTo
    {
        // untuk mendapatkan data dari relasi belongsTo dengan table brand dengan kaitan branch_id
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value); // otomatis buat slug dari name
    }

    /**
     * Boot method to listen to model events for debugging
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::channel('stack')->debug('🔍 [Product] Creating Event Triggered', [
                'name' => $model->name,
                'thumbnail' => $model->thumbnail,
                'attributes' => $model->attributes,
            ]);
        });

        static::created(function ($model) {
            Log::channel('stack')->info('✅ [Product] Created Event Completed', [
                'id' => $model->id,
                'name' => $model->name,
                'thumbnail_final' => $model->thumbnail,
            ]);
        });

        static::updating(function ($model) {
            Log::channel('stack')->debug('🔍 [Product] Updating Event', [
                'id' => $model->id,
                'dirty' => $model->getDirty(),
            ]);
        });

        static::updated(function ($model) {
            Log::channel('stack')->info('✅ [Product] Updated Event', [
                'id' => $model->id,
                'thumbnail_final' => $model->thumbnail,
            ]);
        });
    }
}
