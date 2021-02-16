<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Cart
 * @package App\Admin_panel_models
 */
class Cart extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Каждый Cart пренадлежит Product.
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Каждый Cart пренадлежит Condition.
     *
     * @return BelongsTo
     */
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
