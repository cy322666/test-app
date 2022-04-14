<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'is_publish',
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $dates = [
        'deleted_at'
    ];

    protected array $softCascade = [
        'categories'
    ];

    public static function boot()
    {
        parent::boot();

        self::generateUuid();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Открепляет текущие категории и устанавливает новые
     *
     * @param array $array_uuids Массив с uuids категорий
     * @return void
     */
    public function attachCategories(array $array_uuids)
    {
        $this->categories()->detach();

        foreach ($array_uuids as $category_uuid) {

            $this->categories()->attach([

                'uuid' => Category::query()
                    ->find($category_uuid)
                    ->firstOrFail()
                    ?->id,
            ]);
        }
    }
}
