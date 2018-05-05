<?php

namespace App\Helpers;

use Illuminate\Database\Migrations\Migration as BaseMigration;

class Migration extends BaseMigration
{
	/**
		*	Base para migrations
		* Añade el prefijo a la tabla de la DB
		*	usando $this->prefix
		* @param configurar variable $module de acuerdo al module 
		*/
   protected $module;
   protected $prefix;

   public function __construct()
   {
   		$this->prefix = config($this->module . '.prefix_db', '');
    	$this->table = $this->prefix . $this->table;
   }

   
}
