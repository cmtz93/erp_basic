<?php

namespace Modules\Inventory\Models;

use App\Helpers\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeProduct extends Pivot
{
  protected $module = 'inventory';
  protected $table =  'attribute_products';

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
}
