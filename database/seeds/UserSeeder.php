<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(3),
            'email' => Str::random(3).'@ongc.co.in',
            'password' => Hash::make('ongc@123'),
            'Phone'=> '1234567890',
            'location'=>'CMD',
            'user_type'=>'Normal'
        ]);
    }
}
