<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Admin_panel_models\Product');
    }

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
