<?php

namespace App\Admin_panel_models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['number'];

    public function order()
    {
        return $this->hasOne(Order::class)->with('user');
    }

    public function getWaiterName()
    {
        return $this->order->user->name;
    }
}
