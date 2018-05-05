<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Funindes\Http\Concerns\Filterable;

class Activity extends Model
{
  use Filterable, SoftDeletes;
	/**
   * Fillable fields for a Profile.
   *
   * @var array
   */
  protected $fillable = [
    'description',
    'user_type',
    'user_id',
    'route',
    'ip_address',
    'user_agent',
    'locale',
    'referer',
    'method_type',
  ];

  protected $casts = [
    'description'   => 'string',
    'user_id'       => 'integer',
    'route'         => 'url',
    'ip_address'    => 'ipAddress',
    'user_agent'    => 'string',
    'locale'        => 'string',
    'referer'       => 'url',
    'method_type'   => 'string',
  ];

  protected $appends = ['method'];

  public function user()
  {
  	return $this->belongsTo(User::class);
  }

  public function getMethodAttribute()
  {
    switch (strtolower($this->method_type)) {
      case 'post':
        $verb = 'CREAR'; break;
      case 'patch':
      case 'put':
        $verb = 'MODIFICAR'; break;
      case 'delete':
        $verb = 'ELMINAR'; break;
      case 'get':
      default:
        $verb = 'VER'; break;
    }
    return $verb;
  }
}
