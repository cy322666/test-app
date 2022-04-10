<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid as UuidService;

trait Uuid
{
    public static function generateUuid()
    {
        self::creating(function ($model) {

            $model->uuid = (string)UuidService::uuid4();
        });
    }
}
