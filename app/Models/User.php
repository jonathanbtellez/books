<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $fillable = [
		'number_id',
        'name',
		'last_name',
        'email',
        'password',
    ];

	// search the accesories that name make match with the name pass as attribute
	protected $appends = ['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
    ];

	//Create a new user
	// new User($request->all())->save()

	//Mutations --- before consult
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	public function setRememberTokenAttribute()
	{
		$this->attributes['remember_token'] = Str::random(30);
	}


	//Accesores --- after consult
	// user::query()->getFullnameAttribute()->get()
	public function getFullnameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	public function ownerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}

	public function customerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

}
