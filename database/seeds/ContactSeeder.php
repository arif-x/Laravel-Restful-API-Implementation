<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Contact::truncate();

    	$faker  = \Faker\Factory::create();

    	for($i = 0; $i < 50; $i++){
    		Contact::create([
    			'name' => $faker->name,
    			'phone' => $faker->phoneNumber,
    		]        		
    	);
    	}
    }
}
