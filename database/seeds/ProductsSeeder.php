<?php

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

        for ($i = 0; $i < 20; $i++) {
            $products[] = [
                'name' => Str::random(20),
                'section_id' => rand(1, 3),
                'description' => Str::random(150),
                'weight' => rand(100, 400),
                'price' => rand(40, 400),
                'status' => rand(0, 1),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        DB::table('products')->insert($products);

    }
}
