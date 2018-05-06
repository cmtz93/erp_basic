<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Manufacturer extends Model
{
  use \App\Http\Concerns\Coverable;

  protected $table = 'manufacturers';
  protected $module = 'inventory';

  protected $fillable = [
  	'name',
  	'quality',
  	'cover',
  	'icon',
  	'status'
  ];

  protected $casts = [
  	'quality' => 'integer',
  	'status'	=> 'boolean',
  ];

  protected $dates = [
    'deleted_at'
  ];

  public function products()
  {
  	return $this->hasMany(Product::class);
  }

  public function scopeQuality($query, $value)
  {
    return $query->whereQuality($value);
  }

}
