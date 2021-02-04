<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function order()
    {
        return $this->hasOne(Order::class);
    }

}
