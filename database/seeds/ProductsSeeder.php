<?php

use App\Admin_panel_models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [];
        $menu = DatabaseSeeder::MENU;

        $section_id = 1;
        foreach ($menu as $section) {
            foreach ($section as $key => $product) {

                $products[] = [
                    'name' => $product,
                    'section_id' => $section_id,
                    'position' => $key + 1,
                    'description' => 'A small river named Duden flows by their place and supplies',
                    'weight' => rand(100, 400),
                    'price' => rand(40, 400),
                    'status' => rand(0, 1),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
            ++$section_id;
        }

        DB::table('products')->insert($products);

    }
}
