<?php

namespace App\Filters\Products;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

interface FilterInterface
{
    public function searchByRequest(FormRequest $request) : Builder|Relation;
}
