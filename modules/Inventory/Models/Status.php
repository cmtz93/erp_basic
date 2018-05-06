<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Status extends Model
{
  protected $module = 'inventory';
  protected $table =  'statuses';
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  	'name',
  	'description',
  	'status',
	];

	protected $casts = [
		'status' => 'boolean'
	];
  
  protected $dates = [
    'deleted_at'
  ];

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
