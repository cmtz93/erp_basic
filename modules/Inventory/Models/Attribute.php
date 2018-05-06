<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Attribute extends Model
{
  protected $table = 'attributes';
  protected $module = 'inventory';

  protected $fillable = [
  	'name',
    'description',
  	'value_type',
  	'status',
  	'is_stock',
    'category_id',
    'required',
  ];

  protected $casts = [
    'status'    => 'boolean',
    'required'  => 'boolean',
    'is_stock'  => 'boolean',
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

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function scopeCategory($query, $category_id)
  {
    return $query->where('category_id', $category_id);
  }
}
