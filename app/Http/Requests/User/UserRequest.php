<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'number_id' => ['required', 'string'],
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'email' => ['required', 'email'],
			'password' => ['required', 'string', 'min:8'],
		];

		if($this->method() == 'POST'){
			array_push($rules['number_id'], 'unique:users,number_id');
			array_push($rules['email'], 'unique:users,email');
			array_push($rules['password'], 'confirmed');
		}else{
			array_push($rules['number_id'], 'unique:users,number_id,'.$this->user->id);
			array_push($rules['email'], 'unique:users,email,'.$this->user->id);
		}

		if($this->path() != 'api/register'){
			$rules['role'] = ['required','string','in:user,admin'];
		}

		return $rules;
	}



	public function messages(){
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre no debe tener numeros',
		];
	}
}
