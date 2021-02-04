<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
