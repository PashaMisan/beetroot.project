<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public const MENU = [
        'STARTERS' => [
            'Cornish - Mackerel',
            'Roasted Steak',
            'Seasonal Soup',
            'Chicken Curry'
        ],
        'MAIN DISHES' => [
            'Sea Trout',
            'Roasted Beef',
            'Butter Fried Chicken',
            'Chiken Filet'
        ],
        'DESSERTS' => [
            'Cornish - Mackerel',
            'Roasted Steak',
            'Seasonal Soup',
            'Chicken Curry'
        ],
        'DRINKS' => [
            'Sea Trout',
            'Roasted Beef',
            'Butter Fried Chicken',
            'Chiken Filet'
        ]
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersSeeder::class);
         $this->call(SectionsSeeder::class);
         $this->call(ProductsSeeder::class);
    }
}
