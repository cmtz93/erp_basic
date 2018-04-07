<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

  protected $fillable = ["name","description","cover","icon","status","category_id"];



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
}
