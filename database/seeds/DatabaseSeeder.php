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

    public const USERS = [
        'Admin' => [
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ],
        'John' => [
            'email' => 'john@gmail.com',
            'password' => 'john',
        ]
    ];

    public const ROLES = ['administrator', 'waiter'];
    public const ABILITIES = ['change_menu'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesSeeder::class);
         $this->call(AbilitiesSeeder::class);
         $this->call(UsersSeeder::class);
         $this->call(SectionsSeeder::class);
         $this->call(ProductsSeeder::class);
         $this->call(TablesSeeder::class);
    }
}
