<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ['Open', 'Call', 'Ordered', 'Payment request'];
        $status = [];

        foreach ($actions as $action) {
            $status [] = [
                'name' => $action,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }

        DB::table('statuses')->insert($status);
    }
}
