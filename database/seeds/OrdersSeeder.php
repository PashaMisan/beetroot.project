<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($orders = [], $i = 1; $i < 3; $i++) {
            $orders[] = [
                'table_id' => ($i == 1) ? rand(1, 3) : rand(4, 5),
                'user_id' => 2,
                'key' => 'test',
                'qr' => 'test',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
