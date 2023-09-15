<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
		'biography'
	];

	protected $appends = ['format_biography'];
	public function formatBiography(): Attribute
	{
		return Attribute::make(
			get: function ($value, $attributes) {
				return Str::limit($attributes['biography'], 80,  '...');
			},
			// set: fn ($value) => Str::upper($value)
		);
	}


	// author -> with (' books ') -> get()
	public function books()
	{
		return $this->hasMany(Book::class, 'author_id', 'id');
	}

}
