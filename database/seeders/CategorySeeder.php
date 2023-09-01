<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Category::create(['name' => 'horror']);
		Category::create(['name' => 'suspence']);
		Category::create(['name' => 'action']);
		Category::create(['name' => 'comedy']);
		Category::create(['name' => 'Classics']);
		Category::create(['name' => 'Fantasy']);

	}
}
