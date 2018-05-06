<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;
use App\Http\Concerns\Coverable;

class Product extends Model
{
  use Coverable;

  protected $table = 'products';
  protected $module = 'inventory';

  protected $fillable = [
    'name',
    'sku',
    'barcode',
    'description',
    'cover',
    'status_id',
    'category_id',
    'manufacturer_id',
  ];

  protected $casts = [
    'status' => 'boolean'
  ];

  protected $dates = [
    'deleted_at'
  ];

  public function manufacturer()
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

  public function status()
  {
    return $this->belongsTo(Status::class);
  }

  /**SCOPES FOR FILTERS**/
  public function scopeCategory($query, $category_id)
  {
    return $query->where('category_id', $category_id);
  }

  public function scopeManufacturer($query, $manufacturer_id)
  {
    return $query->where('manufacturer_id', $manufacturer_id);
  }
}
