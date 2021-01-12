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

        return $this->status;
    }

    static function swapping($position, $section)
    {
        $sections = Product::whereSection_id($section)
            ->wherePosition($position)
            ->orWhere('section_id', $section)
            ->wherePosition($position - 1)
            ->get();
        $sort = $sections->sortBy('position')->values();
        for ($i = 0; $i <= 1; $i++) {
            ($i) ? $sort[$i]->position -= 1 : $sort[$i]->position += 1;
            $sort[$i]->save();
        }

        return true;
    }

    static function incrementPositions($section_id)
    {
        Product::whereSection_id($section_id)
            ->orderBy('position')->get()->each(function ($item, $key) {
                $item->position = ++$key;
                $item->save();
            });

        return true;
    }
}
