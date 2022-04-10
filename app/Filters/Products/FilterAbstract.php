<?php

namespace App\Filters\Products;

use Illuminate\Http\Request;

class FilterAbstract
{
    /**
     * @var Request Объект запроса (сильная связность!)
     */
    protected Request $request;

    /**
     * Устанавливает объект запроса для обработки параметров
     *
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request): static
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return void Инициализирует параметры для каждого вида фильтра
     */
    protected function initParams() {}

    /**
     * @return void Валидирует параметры для каждого вида фильтра
     */
    protected function validateParams() {}
}
