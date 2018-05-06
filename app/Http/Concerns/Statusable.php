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

  public static function scopeStatusId($query, $status_id)
  {
      return $query->where('status_id', $status_id);
  }

  public static function scopeStatus($query, $status)
  {
      return $query->where('status', $status);
  }
}
