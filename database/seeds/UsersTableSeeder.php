<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
        [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'status' => 1,
            'email' => 'admin@gmail.com',
            'phone' => 1111111,
            'password' => bcrypt('secret'),
        ]);
    }
}
