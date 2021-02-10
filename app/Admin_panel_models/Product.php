<?php

namespace App\Admin_panel_models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

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

    /**
     * Deletes an object of this class and then increments the positions of the products.
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteAndIncrement()
    {
        $this->delete();
        $this->incrementRowBySection();

        return true;
    }

    /**
     * Increments product positions in each section.
     *
     * @return bool
     */
    public function incrementRowBySection()
    {
        foreach (Section::all() as $section) {
            Product::whereSection_id($section->id)
                ->orderBy('position')->get()->each(function ($item, $key) {
                    $item->position = ++$key;
                    $item->save();
                });
        }
        return true;
    }

    /**
     * Метод возвращает рандомные продукты из БД.
     *
     * В аргументе необходимо указать айди секции из которой нужно брать продукты, и по необходимости количество
     * этих продуктов.
     *
     * @param $sectionId
     * @param int $quantity
     * @return mixed
     */
    static function randomProducts($sectionId, $quantity = 4)
    {
        return Product::whereSection_id($sectionId)->whereStatus(1)->inRandomOrder()->take($quantity)->get();
    }
}
