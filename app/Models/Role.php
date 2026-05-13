<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'guard_name',
    ];

    /**
     * Relasi: Role memiliki banyak User (many-to-many)
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')->withTimestamps();
    }

    /**
     * Scope untuk mendapatkan role berdasarkan nama
     */
    public function scopeByName($query, string $name)
    {
        return $query->where('name', $name);
    }
}
