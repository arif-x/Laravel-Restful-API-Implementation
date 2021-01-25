<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();

    	$faker = \Faker\Factory::create();

    	$password = Hash::make('12345678');

    	User::create([
    		'name' => 'Admin',
    		'email' => 'admin@mail.test',
    		'password' => $password,
    	]);

    	for($i = 0; $i < 49; $i++){
    		User::create([
    			'name' => $faker->name,
    			'email' => $faker->email,
    			'password' => $password,
    		]);
    	}
    }
}
