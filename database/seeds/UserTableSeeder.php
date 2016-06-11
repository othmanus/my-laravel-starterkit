<?php

use Illuminate\Database\Seeder;

use App\Models\User\User;
use App\Models\Shop\Shop;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		DB::update("ALTER TABLE users AUTO_INCREMENT = 1");

		$user = User::create([
			'email' 	=> 'admin@starter.kit',
			'password' 	=> 'starterkit',
			'role' 		=> 'administrator'
		]);

	}

}
