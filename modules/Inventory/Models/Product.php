<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Product extends Model
{
  protected $table = 'products';
  protected $module = 'inventory';

  protected $fillable = [
    'name',
    'sku',
    'barcode',
    'description',
    'cover',
    'status',
    'category_id',
    'manufacturer_id',
  ];

  protected $casts = [
    'status' => 'boolean'
  ];

  protected $dates = [
    'deleted_at'
  ];

  public function brand()
  {
  	return $this->belongsTo(Manufacturer::class);
  }

  public function category()
  {
  	return $this->belongsTo(Category::class);
  }

  public function attributes()
  {
  	return $this->belongsToMany(Attribute::class, 'attribute_product')->withPivot('value');
  }
}
