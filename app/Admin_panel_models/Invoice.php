<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Каждый Invoice имеет свой Order.
     *
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * Обновление актуальной итоговой суммы чека (поле sum).
     *
     * Метод получает объект Order которым владеет и вызывает у него метод productArr(). Полученный массив с продуктами
     * фильтруется на наличие Accept condition (принятое состояние). После чего вычисляется общая сумма товаров по ключу
     * fullPrice.
     *
     * @return void
     */
    public function sumUpdate(): void
    {
        $this->update([
            'sum' => $this->getArray_sum($this->order->productArr('Accepted'))
        ]);
    }

    /**
     * Вычисление общей суммы товаров по ключу fullPrice.
     *
     * Метод получает массив с продуктами и вычисляет общую сумму товаров по ключу fullPrice.
     *
     * @param array $arr
     * @return float|int
     */
    public function getArray_sum(array $arr): int
    {
        return array_sum(array_column($arr, 'fullPrice'));
    }
}
