<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		User::factory(10)->create();
		$user = new User([
			'number_id' => 123456789,
			'name' => 'Jonathan',
			'last_name' => 'Tellez',
			'email' => 'jonathanbtellez@gmail.com',
			'password' => 12345678,
			'remember_token' => Str::random(10),
		]);
		$user->save();
		$user->assignRole('admin');
	}
}
