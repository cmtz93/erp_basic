<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Concerns\Filterable;
use App\Http\Concerns\Statusable;

class Model extends BaseModel
{
	use SoftDeletes, Filterable, Statusable;

	/**
		*	Base para Modelos
		* Añade el prefijo a la tabla de la DB
		*	usando $this->prefix
		* @param configurar variable $module de acuerdo al module 
		* @param configurar variable $table con nombre de la tabla
		*/
	protected $module;
	protected $prefix;

	protected $perPage = 25;

  public function __construct(array $attributes = [])
  {
    $this->prefix = config($this->module . '.prefix_db' , '');
    $this->table = $this->prefix . $this->table;
    parent::__construct($attributes);
  }

  public static function table()
  {
  	return $this->table;
  }

}
