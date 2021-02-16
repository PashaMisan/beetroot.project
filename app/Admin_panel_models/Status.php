<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Status
 * @package App\Admin_panel_models
 */
class Status extends Model
{
    /**
     * Каждый Status имеет множество Order.
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
