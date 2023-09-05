<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
		$rules = [
			'category_id' => ['required', 'exists:categories,id'],
			'author_id' => ['required', 'exists:authors,id'],
			'name' => ['required'],
			'stock' => ['required', 'numeric'],
			'description' => ['max:255']
		];
		return $rules;
	}
}
