<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [];
        $menu = DatabaseSeeder::MENU;

        for ($i = 0; $i < count($menu); $i++) {
            $sections[] = [
                'name' => key($menu),
                'position' => 1 + $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
            next($menu);
        }

        DB::table('sections')->insert($sections);
    }
}
