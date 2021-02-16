<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Table
 * @package App\Admin_panel_models
 */
class Table extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['number'];

    /**
     * Каждый Table имеет свой Order вместе с User и Status.
     *
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class)->with('user', 'status');
    }

    /**
     * Метод возвращает имя официанта к которому привязан активный столик.
     *
     * @return mixed
     */
    public function getWaiterName()
    {
        return $this->order->user->name;
    }

    /**
     * Метод возвращает значения статуса активного столика.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->order->status->name;
    }
}
