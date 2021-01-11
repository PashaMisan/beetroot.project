<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'section_id', 'description', 'weight', 'price', 'status'];

    public function changeStatus()
    {
        $this->update([
            'status' => $this->status ? 0 : 1
        ]);

    }
}
