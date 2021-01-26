<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['number'];

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
