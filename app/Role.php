<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Concerns\Filterable;
use App\Http\Concerns\Statusable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use SoftDeletes, Filterable, Statusable;

	protected $fillable = [
		'name',
		'display_name', 
		'description',
		'status'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class);
	}

}
