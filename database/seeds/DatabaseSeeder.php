<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Super Admintrator',
            'email' => 'super.admin@dascam.com',
            'password' =>Hash::make('superadmin'),
            'status' => 1,
            'role_id' => 1,
            'description' => 'System super admin'
        ]);

    }
}
