<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

	 public function authorId($author){
		return $this->state([
			'author_id' => $author->id
		]);
	 }
    public function definition(): array
    {
        return [
            'category_id'=> fake()->randomElement([1,2,3,4,5,6]),
            'name'=> fake()->sentence(),
            'stock'=> fake()->randomDigit(),
			'description'=> fake()->paragraph(),

        ];
    }

	public function configure(){
		return $this->afterCreating(function (Book $book){
			$file = new File(['route'=> '/storage/images/books/default.png']);
			$book->file()->save($file);
		});
	}
}
