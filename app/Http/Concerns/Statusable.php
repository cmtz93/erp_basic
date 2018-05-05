<?php

namespace App\Http\Concerns;

trait Statusable
{
  public static function scopeActive($query)
  {
	  return $query->where('status',1);
  }

  public static function scopeInactive($query)
  {
    return $query->where('status',0);
  }

  public static function scopeStatus($query, $status)
  {
  	return $query->where('status', $status);
  }
}
