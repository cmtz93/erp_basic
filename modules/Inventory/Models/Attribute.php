<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Attribute extends Model
{
  protected $table = 'attributes';
  protected $module = 'inventory';

  protected $fillable = [
  	'name',
  	'value_type',
  	'status',
  	'is_stock',
  ];

  protected $casts = [
    'status'  => 'boolean',
  ];

  protected $dates = [
    'deleted_at'
  ];

  public function values()
  {
  	return $this->hasMany(Value::class);
  }

  public function products()
  {
  	return $this->belongsToMany(Product::class, 'attribute_product');
  }
}
