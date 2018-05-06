<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeProduct extends Pivot
{
  protected $module = 'inventory';
  protected $table =  'attribute_product';

  public function __construct(array $attributes = [])
  {
    $this->prefix = config($this->module . '.prefix_db' , '');
    $this->table = $this->prefix . $this->table;
    parent::__construct($attributes);
  }
    
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  	'attribute_id',
  	'product_id',
  	'value',
  	'value_id'
  ];

  public function attribute()
  {
  	return $this->belongsTo(Attribute::class);
  }

  public function product()
  {
  	return $this->belongsTo(Product::class);
  }
  public function option()
  {
  	return $this->belongsTo(Value::class);
  }
}
