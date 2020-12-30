<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function products()
    {
        return $this->hasMany('App\Admin_panel_models\Product');
    }
}
