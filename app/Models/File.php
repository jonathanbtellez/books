<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

	protected $filleable = [
		'fileable_id',
		'fileable_type',
		'route'
	];

	public function fileable(){
		return $this->morphTo();
	}
}
