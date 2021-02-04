<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
