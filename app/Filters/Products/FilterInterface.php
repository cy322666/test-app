<?php

namespace App\Filters\Products;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

interface FilterInterface
{
    public function search() : Builder|Relation;
}
