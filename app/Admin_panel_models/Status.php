<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
