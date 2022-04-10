<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, Uuid;

    const DELETED_USE_MESSAGE = 'Category used';

    const MIN_COUNT_CATEGORY = 2;
    const MAX_COUNT_CATEGORY = 10;

    protected $fillable = [
        'uuid',
        'name',
    ];

    protected $hidden = [
        'id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();

        self::generateUuid();
    }
}
