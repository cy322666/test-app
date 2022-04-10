<?php

namespace App\Filters\Products;

use Illuminate\Http\Request;

abstract class FilterFactory
{
    /**
     * Исходя из запрошенного фильтра отдает объект для фильтрации Products
     * Если тип фильтрации не распознан отдает класс для выдачи всех Products
     *
     * @param Request $request Объект запроса для получения параметров фильтрации
     * @return FilterInterface Интерфейс для классов - фильтров
     */
    public static function getFilter(Request $request): FilterInterface
    {
        return match ($request->input('filter')) {

            'product_name'  => new FilterProductName(),
            'category_uuid' => new FilterCategoryUuid(),
            'category_name' => new FilterCategoryName(),
            'price'   => new FilterPrice(),
            'publish' => new FilterPublish(),
            'deleted' => new FilterDeleted(),

            default   => new FilterDefault(),
        };
    }
}
