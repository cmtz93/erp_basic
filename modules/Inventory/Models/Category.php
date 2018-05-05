<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;
use App\Http\Concerns\Coverable;

class Category extends Model
{
  use Coverable;
  protected $table = 'categories';
  protected $module = 'inventory';
  private $cover_path = '/categories/';

  protected $fillable = [
    "name",
    "description",
    "cover",
    "icon",
    "status",
    "category_id"
  ];
  
  protected $casts = [
    'status'  => 'boolean',
  ];

  protected $dates = [
    'deleted_at'
  ];

  public function parent()
  {
  	return $this->belongsTo(Category::class, 'category_id');
  }

  public function childs()
  {
  	return $this->hasMany(Category::class);
  }

  public function products()
  {
  	return $this->hasMany(Product::class);
  }



  public function scopeCategory($query, $category_id)
  {
    return $query->where('category_id', $category_id);
  }
}
