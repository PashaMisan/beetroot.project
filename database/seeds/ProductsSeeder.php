<?php

use App\Admin_panel_models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        File::makeDirectory('storage/app/public/uploads/');

        for ($i = 1; $i <= 27; $i++) {
            copy('public/images/randomMenu/' . $i . '.jpg', 'storage/app/public/uploads/' . $i . '.jpg');
        }

        $products = [];
        $menu = DatabaseSeeder::MENU;

        $section_id = 1;
        foreach ($menu as $key1 => $section) {
            foreach ($section as $key => $product) {

                $products[] = [
                    'name' => $product,
                    'section_id' => $section_id,
                    'position' => $key + 1,
                    'description' => 'A small river named Duden flows by their place and supplies',
                    'text' => file_get_contents('https://loripsum.net/api/1/medium/plaintext'),
                    'weight' => rand(100, 400),
                    'price' => rand(40, 400),
                    'image' => ($key1 === 'DRINKS') ? 'uploads/' . rand(19, 24) . '.jpg' : 'uploads/' . rand(1, 18) . '.jpg',
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
