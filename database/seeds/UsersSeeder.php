<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        foreach (DatabaseSeeder::USERS as $userName => $userData) {
            $users[] = [
                'name' => $userName,
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        DB::table('users')->insert($users);

        $roleUser = [];
        foreach (User::all() as $key => $user) {
            $roleUser[] = [
                'user_id' => $user->id,
                'role_id' => ++$key,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        DB::table('role_user')->insert($roleUser);
    }
}
