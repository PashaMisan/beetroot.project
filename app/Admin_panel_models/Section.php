<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Section
 * @package App\Admin_panel_models
 */
class Section extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Каждая Section имеет множество Product.
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Admin_panel_models\Product');
    }

    /**
     * Метод меняет позицию секции в списке по полю 'position'.
     *
     * @param $position
     * @return bool
     */
    static function swapping($position)
    {
        $sections = Section::where('position', $position)
            ->orwhere('position', $position - 1)
            ->get();

        $sort = $sections->sortBy('position')->values();
        for ($i = 0; $i <= 1; $i++) {
            ($i) ? $sort[$i]->position -= 1 : $sort[$i]->position += 1;
            $sort[$i]->save();
        }

        return true;
    }

    /**
     * Метод обновляет позиции секций в списке при помощи поля 'position'.
     *
     * @return bool
     */
    static function incrementPositions()
    {
        Section::all()
            ->sortBy('position')
            ->values()
            ->each(function ($item, $key) {
                $item->position = ++$key;
                $item->save();
            });

        return true;
    }

}
