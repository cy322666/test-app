<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'uuid',
        'name',
        'price',
        'is_publish',
        'is_deleted',
    ];

    protected $hidden = [
        'id',
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
                    ->where('uuid', $category_uuid)
                    ->firstOrFail()
                    ?->id,
            ]);
        }
    }
}
