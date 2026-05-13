<?php

// app/Models/Brand.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use SoftDeletes; // Tambahkan ini

    protected $fillable = ['name', 'slug', 'logo'];

    protected static function booted()
    {
        static::creating(fn ($brand) => $brand->slug = Str::slug($brand->name));
        static::updating(fn ($brand) => $brand->slug = Str::slug($brand->name));
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
