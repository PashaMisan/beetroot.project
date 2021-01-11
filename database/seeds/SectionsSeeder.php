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
        $sectionsName = [
            'STARTERS',
            'SEAFOOD',
            'DESSERTS',
            'MAIN DISHES'
        ];

        for ($i = 0; $i < count($sectionsName); $i++) {
            $sections[] = [
                'name' => $sectionsName[$i],
                'position' => 1 + $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        DB::table('sections')->insert($sections);

    }
}
