<?php

namespace App\Http\Concerns;

trait Filterable
{
  function scopeFilter($query, $filters)
  {
    foreach ($filters as $scope => $value) {
      if (!empty($value) || $value === '0') {
	        $query->$scope($value);
      }
    }
  }

  public function scopeName($query, $value)
  {
  	return $query->where('name','LIKE', '%'.$value.'%');
  }
}
