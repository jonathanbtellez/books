<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
			'biography' => fake()->paragraph()
        ];
    }

	public function configure(){
		return $this->afterCreating(function (Author $author){
			Book::factory(8)->authorId($author)->create();
		});
	}

}
