<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Richard',
            'last_name' => 'Protasov',
            'email' => 'richard@protasov.io',
            'password' => bcrypt('secret'),
            'email_confirmed' => false,
            'remember_me' => false,
        ]);

        DB::table('users')->insert([
            'first_name' => 'Nick',
            'last_name' => 'Becker',
            'email' => 'nickbecker@google.com',
            'password' => bcrypt('secret'),
            'email_confirmed' => false,
            'remember_me' => false,
        ]);
    }
}
