<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

class Value extends Model
{
  protected $table = 'values';
  protected $module = 'inventory';
  
  protected $fillable = [
  	'value',
  	'status',
  	'attribute_id'
  ];

  protected $dates = [
    'deleted_at'
  ];

  protected $casts = [
  	'status' => 'boolean'
  ];

  public function attribute()
  {
  	return $this->belongsTo(Attribute::class);
  }


  public function scopeAttribute($query, $attribute_id)
  {
    return $query->where('attribute_id', $attribute_id);
  }

  public function scopeValue($query, $value)
  {
    return $query->whereValue($value);
  }
}
